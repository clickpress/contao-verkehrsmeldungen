<?php
namespace Clickpress\ContaoVerkehrsmeldungen\Controller\FrontendModule;

use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\CoreBundle\Routing\ResponseContext\HtmlHeadBag\HtmlHeadBag;
use Contao\CoreBundle\Routing\ResponseContext\ResponseContextAccessor;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\Database;
use Contao\Date;
use Contao\Environment;
use Contao\FilesModel;
use Contao\Input;
use Contao\ModuleModel;
use Contao\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule('verkehrsmeldungen_detail', category: 'revg')]
class VerkehrsmeldungenDetailController extends AbstractFrontendModuleController
{
    public const TYPE = 'verkehrsmeldungen_detail';
    private ResponseContextAccessor $responseContextAccessor;
    public function __construct(ResponseContextAccessor $responseContextAccessor)
    {
        $this->responseContextAccessor = $responseContextAccessor;
    }

    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {

        $page = $this->getPageModel();
        $time = Date::floorToMinute();
        $db = Database::getInstance();
        $template->error = null;
        $template->minifahrplanLink = null;

        $objCat = $db->prepare("SELECT * FROM tl_verkehrsmeldungen_category WHERE linie=?")
                    ->execute(Input::get('linie')
        );

        if ($objCat->numRows < 1) {
            // Do not index or cache the page
            $page->noSearch = 1;
            $page->cache    = 0;

            throw new PageNotFoundException('Page not found: ' . Environment::get('uri'));

            // Send a 404 header
            // header('HTTP/1.1 404 Not Found');
            // $this->Template->error = '<p class="error">' . sprintf($GLOBALS['TL_LANG']['MSC']['invalidPage'], $this->Input->get('linie')) . '</p>';
            // return;
        }

        $arrCat = $objCat->fetchAssoc();

        // Change page title
        $htmlHeadBag = $this->responseContextAccessor->getResponseContext()->get(HtmlHeadBag::class);
        $htmlHeadBag->setTitle('Linie ' . $arrCat['linie']);

        $template->linie = $arrCat['linie'];
        $template->minifahrplanLink = null;

        if ($arrCat['addEnclosure']) {
            $objFile = FilesModel::findByUuid($arrCat['enclosure']);

            if ($objFile !== null) {
                $template->minifahrplanLink = $objFile->path;
            }
        }

        $template->rvk = $objCat->rvk;
        $template->minifahrplan = $arrCat['addEnclosure'];

        $objFahrt = $db->prepare(
        "SELECT * FROM tl_verkehrsmeldungen_detail 
                WHERE pid=? AND (start='' OR start<='$time') 
                AND (stop='' OR stop>'" . ($time + 60) . "') 
                AND published=? ORDER BY title ASC"
        )->execute($arrCat['id'], 1);


        $arrAusfaelle = [];
        while ($objFahrt->next()) {

            $arrTemp = $objFahrt->row();

            $arrAusfaelle[] = [
                'addZeit' => $arrTemp['addZeit'] ?? null,
                'abfahrtszeit' => $arrTemp['abfahrtszeit'] ?? null,
                'ankunftszeit' => $arrTemp['ankunftszeit'] ?? null,
                'abfahrtsort' => $arrTemp['abfahrtsort'] ?? null,
                'ankunftsort' => $arrTemp['ankunftsort'] ?? null,
                'ursache' => $arrTemp['ursache'] ?? null,
                'addInfo' => $arrTemp['addInfo'] ?? null,
                'weitereInfos' => $arrTemp['weitereInfos'] ?? null,
                'icon' => $arrTemp['icon'] ?? null,
                'tstamp' => $arrTemp['tstamp'] ?? null,
                'title' => $arrTemp['title'] ?? null,
                'entrytext' => $arrTemp['entrytext'] ?? null,
                'text' => $arrTemp['text'] ?? null,
                'start' => $arrTemp['start'] ?? null,
                'stop' => $arrTemp['stop'] ?? null,
            ];
        }

        $template->ausfaelleAnzahl = (is_array($arrAusfaelle)) ? count($arrAusfaelle) : null;
        $template->ausfaelle       = $arrAusfaelle;

        return $template->getResponse();
    }
}
