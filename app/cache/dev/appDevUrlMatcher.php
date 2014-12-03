<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/css/compiled/all')) {
            // _assetic_9645991
            if ($pathinfo === '/css/compiled/all.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 9645991,  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_9645991',);
            }

            if (0 === strpos($pathinfo, '/css/compiled/all_')) {
                // _assetic_9645991_0
                if ($pathinfo === '/css/compiled/all_bootstrap.min_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 9645991,  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_9645991_0',);
                }

                // _assetic_9645991_1
                if ($pathinfo === '/css/compiled/all_main_2.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 9645991,  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_9645991_1',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js/compiled/all')) {
            // _assetic_23042c6
            if ($pathinfo === '/js/compiled/all.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => '23042c6',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_23042c6',);
            }

            if (0 === strpos($pathinfo, '/js/compiled/all_')) {
                // _assetic_23042c6_0
                if ($pathinfo === '/js/compiled/all_modernizr-2.6.2-respond-1.1.0.min_1.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '23042c6',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_23042c6_0',);
                }

                // _assetic_23042c6_1
                if ($pathinfo === '/js/compiled/all_jquery-1.11.1.min_2.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '23042c6',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_23042c6_1',);
                }

                // _assetic_23042c6_2
                if ($pathinfo === '/js/compiled/all_bootstrap.min_3.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => '23042c6',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_23042c6_2',);
                }

                if (0 === strpos($pathinfo, '/js/compiled/all_part_4_')) {
                    // _assetic_23042c6_3
                    if ($pathinfo === '/js/compiled/all_part_4_main_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '23042c6',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_23042c6_3',);
                    }

                    // _assetic_23042c6_4
                    if ($pathinfo === '/js/compiled/all_part_4_plugins_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => '23042c6',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_23042c6_4',);
                    }

                }

            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        // des0ps_app_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'des0ps_app_homepage');
            }

            return array (  '_controller' => 'Des0ps\\AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'des0ps_app_homepage',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
