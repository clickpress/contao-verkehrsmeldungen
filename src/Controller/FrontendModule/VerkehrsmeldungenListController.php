<?php

namespace Clickpress\ContaoVerkehrsmeldungen\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Image\Studio\Studio;
use Contao\CoreBundle\Routing\Page\PageRoute;
use Contao\CoreBundle\Slug\Slug;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\Database;
use Contao\Date;
use Contao\ModuleModel;
use Contao\PageModel;
use Contao\System;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[AsFrontendModule('verkehrsmeldungen_list', category: 'revg')]
class VerkehrsmeldungenListController extends AbstractFrontendModuleController
{

    public const TYPE = 'verkehrsmeldungen_list';

    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly ScopeMatcher $scopeMatcher,
        private readonly UrlGeneratorInterface $urlGenerator
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

        //Generate link
        $model->jumpTo;
        $redirectPage = PageModel::findByPk($model->jumpTo);
        $template->jumpTo = $this->getUrlForPage($redirectPage);

        $db = Database::getInstance();
        $objFa = $db->execute("SELECT * FROM tl_verkehrsmeldungen_category WHERE published=1 ORDER BY linie");

        // $GLOBALS['TL_CSS'][] = 'bundles/revgfahrtausfaelle/style.css';

        $arrLinie = [];
        while ($objFa->next())
        {
            $arrTemp = $objFa->row();

            $objCount = $db->prepare(
                "SELECT COUNT(*) AS cnt 
                         FROM tl_verkehrsmeldungen_detail 
                         WHERE  pid=? AND (start='' OR start<='$time') 
                         AND (stop='' OR stop>'" . ($time + 60) . "') 
                         AND published=? ORDER BY title ASC"
                )
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

    private function getUrlForPage(PageModel $page): string
    {
        return $this->urlGenerator->generate(
            PageRoute::PAGE_BASED_ROUTE_NAME,
            [
                RouteObjectInterface::CONTENT_OBJECT => $page
            ]
        );
    }
}
