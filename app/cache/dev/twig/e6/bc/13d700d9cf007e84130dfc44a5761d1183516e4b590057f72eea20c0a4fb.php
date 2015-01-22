<?php

/* layout.html.twig */
class __TwigTemplate_e6bc13d700d9cf007e84130dfc44a5761d1183516e4b590057f72eea20c0a4fb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'meta_tags' => array($this, 'block_meta_tags'),
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'content' => array($this, 'block_content'),
            'nav' => array($this, 'block_nav'),
            'header' => array($this, 'block_header'),
            'body' => array($this, 'block_body'),
            'footer' => array($this, 'block_footer'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<!--[if lt IE 7]>      <html class=\"no-js lt-ie9 lt-ie8 lt-ie7\"> <![endif]-->
<!--[if IE 7]>         <html class=\"no-js lt-ie9 lt-ie8\"> <![endif]-->
<!--[if IE 8]>         <html class=\"no-js lt-ie9\"> <![endif]-->
<!--[if gt IE 8]><!--> <html class=\"no-js\"> <!--<![endif]-->
    <head>        
        ";
        // line 7
        $this->displayBlock('meta_tags', $context, $blocks);
        // line 15
        echo "        
        ";
        // line 16
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 25
        echo "        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class=\"browsehappy\">You are using an <strong>outdated</strong> browser. Please <a href=\"http://browsehappy.com/\">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        ";
        // line 32
        $this->displayBlock('content', $context, $blocks);
        // line 84
        echo "        
        ";
        // line 85
        $this->displayBlock('javascripts', $context, $blocks);
        // line 107
        echo "    </body>
</html>
";
    }

    // line 7
    public function block_meta_tags($context, array $blocks = array())
    {
        // line 8
        echo "        
        <meta charset=\"utf-8\">
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
        <title>";
        // line 11
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        <meta name=\"description\" content=\"\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">        
        ";
    }

    public function block_title($context, array $blocks = array())
    {
        echo " ";
    }

    // line 16
    public function block_stylesheets($context, array $blocks = array())
    {
        echo "        
        ";
        // line 17
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "6150523_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6150523_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/compiled/all_bootstrap.min_1.css");
            // line 21
            echo "        
        <link rel=\"stylesheet\" href=\"";
            // line 22
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
        ";
            // asset "6150523_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6150523_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/compiled/all_main_2.css");
            // line 21
            echo "        
        <link rel=\"stylesheet\" href=\"";
            // line 22
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
        ";
        } else {
            // asset "6150523"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_6150523") : $this->env->getExtension('assets')->getAssetUrl("_controller/css/compiled/all.css");
            // line 21
            echo "        
        <link rel=\"stylesheet\" href=\"";
            // line 22
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\" />
        ";
        }
        unset($context["asset_url"]);
        // line 23
        echo "        
        ";
    }

    // line 32
    public function block_content($context, array $blocks = array())
    {
        // line 33
        echo "
            ";
        // line 34
        $this->displayBlock('nav', $context, $blocks);
        // line 62
        echo "
            ";
        // line 63
        $this->displayBlock('header', $context, $blocks);
        // line 65
        echo "
            <div class=\"container\">

            ";
        // line 68
        $this->displayBlock('body', $context, $blocks);
        // line 70
        echo "
            ";
        // line 71
        $this->displayBlock('footer', $context, $blocks);
        // line 80
        echo "
            </div> <!-- /container -->
        
        ";
    }

    // line 34
    public function block_nav($context, array $blocks = array())
    {
        // line 35
        echo "        
            <nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
              <div class=\"container\">
                <div class=\"navbar-header\">
                  <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#navbar\" aria-expanded=\"false\" aria-controls=\"navbar\">
                    <span class=\"sr-only\">Toggle navigation</span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                    <span class=\"icon-bar\"></span>
                  </button>
                  <a class=\"navbar-brand\" href=\"#\">Project name</a>
                </div>
                <div id=\"navbar\" class=\"navbar-collapse collapse\">
                  <form class=\"navbar-form navbar-right\" role=\"form\">
                    <div class=\"form-group\">
                      <input type=\"text\" placeholder=\"Email\" class=\"form-control\">
                    </div>
                    <div class=\"form-group\">
                      <input type=\"password\" placeholder=\"Password\" class=\"form-control\">
                    </div>
                    <button type=\"submit\" class=\"btn btn-success\">Sign in</button>
                  </form>
                </div><!--/.navbar-collapse -->
              </div>
            </nav>
        
            ";
    }

    // line 63
    public function block_header($context, array $blocks = array())
    {
        // line 64
        echo "            ";
    }

    // line 68
    public function block_body($context, array $blocks = array())
    {
        // line 69
        echo "            ";
    }

    // line 71
    public function block_footer($context, array $blocks = array())
    {
        // line 72
        echo "                
              <hr>

              <footer>
                <p>&copy; Company 2014</p>
              </footer>
                
            ";
    }

    // line 85
    public function block_javascripts($context, array $blocks = array())
    {
        // line 86
        echo "        
        ";
        // line 87
        if (isset($context['assetic']['debug']) && $context['assetic']['debug']) {
            // asset "add9f7f_0"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_add9f7f_0") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/all_modernizr-2.6.2-respond-1.1.0.min_1.js");
            // line 93
            echo "        
        <script src=\"";
            // line 94
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "add9f7f_1"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_add9f7f_1") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/all_jquery-1.11.1.min_2.js");
            // line 93
            echo "        
        <script src=\"";
            // line 94
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "add9f7f_2"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_add9f7f_2") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/all_bootstrap.min_3.js");
            // line 93
            echo "        
        <script src=\"";
            // line 94
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "add9f7f_3"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_add9f7f_3") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/all_part_4_main_1.js");
            // line 93
            echo "        
        <script src=\"";
            // line 94
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
            // asset "add9f7f_4"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_add9f7f_4") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/all_part_4_plugins_2.js");
            // line 93
            echo "        
        <script src=\"";
            // line 94
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
        } else {
            // asset "add9f7f"
            $context["asset_url"] = isset($context['assetic']['use_controller']) && $context['assetic']['use_controller'] ? $this->env->getExtension('routing')->getPath("_assetic_add9f7f") : $this->env->getExtension('assets')->getAssetUrl("_controller/js/compiled/all.js");
            // line 93
            echo "        
        <script src=\"";
            // line 94
            echo twig_escape_filter($this->env, (isset($context["asset_url"]) ? $context["asset_url"] : $this->getContext($context, "asset_url")), "html", null, true);
            echo "\"></script>
        ";
        }
        unset($context["asset_url"]);
        // line 96
        echo "
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>        
        ";
    }

    public function getTemplateName()
    {
        return "layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  286 => 96,  280 => 94,  277 => 93,  270 => 94,  267 => 93,  261 => 94,  258 => 93,  252 => 94,  249 => 93,  243 => 94,  240 => 93,  234 => 94,  231 => 93,  227 => 87,  224 => 86,  221 => 85,  210 => 72,  207 => 71,  203 => 69,  200 => 68,  196 => 64,  193 => 63,  163 => 35,  160 => 34,  153 => 80,  151 => 71,  148 => 70,  146 => 68,  141 => 65,  139 => 63,  136 => 62,  134 => 34,  131 => 33,  128 => 32,  123 => 23,  117 => 22,  114 => 21,  107 => 22,  104 => 21,  98 => 22,  95 => 21,  91 => 17,  86 => 16,  73 => 11,  68 => 8,  65 => 7,  59 => 107,  57 => 85,  54 => 84,  52 => 32,  43 => 25,  41 => 16,  38 => 15,  36 => 7,  28 => 1,);
    }
}
