<?php

class Videobannerdisplay extends Module
{
    const FORMAT_ALLOWED = ['video/mp4'];
    const PATH = __DIR__ . '/views/video/';

    public function __construct()
    {
        $this->name = 'videobannerdisplay';
        $this->version = '1.0.0';
        $this->author = 'Malagashmalagash';

        parent::__construct();

        $this->displayName = $this->l('Video Banner Display');
        $this->description = $this->l('here to display some videos !');

        $this->bootstrap = true;

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);

    }

    public function install()
    {
        return parent::install() && $this->registerHook('displayHomeSliderFullWidth');
    }

    public function uninstall()
    {
        return parent::uninstall();

    }

    public function hookDisplayHomeSliderFullWidth()
    {
        $this->context->smarty->assign([
            'VIDEOBANNERDISPLAY_STR' => Configuration::get('VIDEOBANNERDISPLAY_STR'),
            'DESCRIPTION_STR' => Configuration::get('DESCRIPTION_STR'),
            'lien' => __FILE__ . 'movie.mp4',
        ]);
        return $this->display(__FILE__,'views/templates/hook/home.tpl');
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function getContent()
    {
        if(Tools::isSubmit('submit_form'))
        {
            $name = Tools::getValue('title');
            $nameDescription = Tools::getValue('description');

            Configuration::updateValue('VIDEOBANNERDISPLAY_STR', $name, true);
            Configuration::updateValue('DESCRIPTION_STR', $nameDescription, true);

            $file = $_FILES['video'];
            $uploadfile = self::PATH . 'movie.mp4';
            unlink($uploadfile);
            Tools::clearAllCache();
            clearstatcache();
            if (in_array($file['type'], self::FORMAT_ALLOWED)) {
                if (move_uploaded_file($file['tmp_name'], $uploadfile)) {
                    echo "Le fichier est valide, et a été téléchargé avec succès. Voici plus d'informations :\n";
                } else {
                    echo $file['error'];
                }
            }
        }

        $this->context->smarty->assign([
            'VIDEOBANNERDISPLAY_STR' => Configuration::get('VIDEOBANNERDISPLAY_STR'),
            'DESCRIPTION_STR' => Configuration::get('DESCRIPTION_STR'),
        ]);

        return $this->display(__FILE__,'views/templates/admin/configure.tpl');
    }
};