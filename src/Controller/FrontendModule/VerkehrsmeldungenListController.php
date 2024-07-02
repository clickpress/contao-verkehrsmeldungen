<?php

namespace Clickpress\ContaoVerkehrsmeldungen\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Slug\Slug;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\Database;
use Contao\Date;
use Contao\ModuleModel;
use Contao\System;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\HttpFoundation\RequestStack;

#[AsFrontendModule('verkehrsmeldungen_list', category: 'revg')]
class VerkehrsmeldungenListController extends AbstractFrontendModuleController
{

    public const TYPE = 'verkehrsmeldungen_list';

    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly ScopeMatcher $scopeMatcher
    )
    {
        //$this->slug = $slug;
        $this->rootDir = System::getContainer()->getParameter('kernel.project_dir');
    }

    public function isFrontend()
    {
        return $this->scopeMatcher->isFrontendRequest($this->requestStack->getCurrentRequest());
    }

    /**
     * @param FragmentTemplate $template
     * @param ModuleModel $model
     * @param Request $request
     * @param $arrLinie
     * @return Response
     * @throws Exception
     */
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $time = Date::floorToMinute();

        // Remove all if no published
        // $objAusfaelle = $this->Database->execute("SELECT id FROM tl_fahrtausfaelle WHERE ankunftszeit>$time AND published=1");
        //
        // if($objAusfaelle->numRows<1) {
        // 	return;
        // }



        $db = Database::getInstance();
        $objFa = $db->execute("SELECT * FROM tl_verkehrsmeldungen_category WHERE published=1 ORDER BY linie");

        // $GLOBALS['TL_CSS'][] = 'bundles/revgfahrtausfaelle/style.css';

        //dump($objFa);

        $arrLinie = [];
        while ($objFa->next())
        {
            $arrTemp = $objFa->row();

            $objCount = $db->prepare("SELECT COUNT(*) AS cnt FROM tl_verkehrsmeldungen_detail WHERE  pid=? AND (start='' OR start<='$time') AND (stop='' OR stop>'" . ($time + 60) . "') AND published=? ORDER BY title ASC")
                ->execute($arrTemp['id'],1);

            $arrLinie[] = array(
                'id' => $arrTemp['id'],
                'tstamp' => $arrTemp['tstamp'],
                'linie' => $arrTemp['linie'],
                'count' => $objCount->cnt
            );
        }

        $template->linie = $arrLinie;
        $template->searchable = false;

        return $template->getResponse();
    }


    /**
     * Create links and remember pages that have been processed
     * @param \Database_Result
     * @return string
     */
    protected function generateLink(\Database_Result $objAusfaelle)
    {
        if (!isset($this->arrTargets[$objAusfaelle->id]))
        {
            if ($objAusfaelle->jumpTo < 1)
            {
                $this->arrTargets[$objAusfaelle->id] = ampersand($this->Environment->request, true);
            }
            else
            {
                $objTarget = $this->Database->prepare("SELECT id, alias FROM tl_page WHERE id=?")
                    ->limit(1)
                    ->execute(intval($objAusfaelle->jumpTo));

                if ($objTarget->numRows < 1)
                {
                    $this->arrTargets[$objAusfaelle->id] = ampersand($this->Environment->request, true);
                }
                else
                {
                    $this->arrTargets[$objAusfaelle->id] = ampersand($this->generateFrontendUrl($objTarget->fetchAssoc(), ($GLOBALS['TL_CONFIG']['useAutoItem'] ?  '/' : '/items/') . (($objAusfaelle->alias != '' && !$GLOBALS['TL_CONFIG']['disableAlias']) ? $objAusfaelle->alias : $objAusfaelle->id)));
                }
            }
        }

        return $this->arrTargets[$objAusfaelle->id];
    }
}
