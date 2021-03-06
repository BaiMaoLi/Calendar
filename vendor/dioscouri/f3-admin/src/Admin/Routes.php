<?php
namespace Admin;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Routes extends \Dsc\Routes\Group
{

    /**
     * Initializes all routes for this group
     * NOTE: This method should be overriden by every group
     */
    public function initialize()
    {
        $this->setDefaults( array(
            'namespace' => '\Admin\Controllers',
            'url_prefix' => '/admin' 
        ) );
        
        $this->add( '', 'GET', array(
            'controller' => 'Dashboard',
            'action' => 'today' 
        ) );
        
        $this->add( '/dashboard/yesterday', 'GET', array(
            'controller' => 'Dashboard',
            'action' => 'yesterday'
        ) );
        
        $this->add( '/dashboard/last-7', 'GET', array(
            'controller' => 'Dashboard',
            'action' => 'last7'
        ) );

        $this->add( '/dashboard/last-30', 'GET', array(
            'controller' => 'Dashboard',
            'action' => 'last30'
        ) );        
        
        $this->add( '/dashboard/last-90', 'GET', array(
            'controller' => 'Dashboard',
            'action' => 'last90'
        ) );        
        
        $this->add( '/dashboard/custom', 'GET', array(
            'controller' => 'Dashboard',
            'action' => 'custom'
        ) );        
        
        $this->add( '/login', 'GET', array(
            'controller' => 'Login',
            'action' => 'login' 
        ) );
        
        $this->add( '/login', 'POST', array(
            'controller' => 'Login',
            'action' => 'auth' 
        ) );
        
        $this->add( '/logout', 'GET', array(
            'controller' => 'Login',
            'action' => 'logout' 
        ) );
        
        $this->add( '/system/@task', 'GET', array(
            'controller' => 'System',
            'action' => '@task' 
        ) );
        
        $this->addSettingsRoutes();
        
        $this->addCrudGroup( 'Logs', 'Log' );
        
        $this->addCrudGroup( 'QueueTasks', 'QueueTask', array(
            'url_prefix' => '/queue/tasks',
        ), array(
            'url_prefix' => '/queue/task',
        ) );
        
        $this->addCrudList( 'QueueArchives', array(
            'url_prefix' => '/queue/archives'       
        ) );
        
        $this->add( '/queue/task/process/@id', 'GET', array(
            'controller' => 'QueueTask',
            'action' => 'process'
        ) );        
        
        $this->add( '/queue/processes', 'GET|POST', array(
        		'controller' => 'QueueTasks',
        		'action' => 'processes'
        ) );
        
        $this->addCrudList( 'Menus' );
        
        $this->add( '/menus/all', 'GET', array(
            'controller' => 'Menus',
            'action' => 'getAll',
            'ajax' => true 
        ) );
        
        $this->add( '/menus/@id', array(
            'GET',
            'POST' 
        ), array(
            'controller' => 'Menus',
            'action' => 'index' 
        ) );
        
        $this->add( '/menus/@id/page/@page', array(
            'GET',
            'POST' 
        ), array(
            'controller' => 'Menus',
            'action' => 'index' 
        ) );
        
        $this->addCrudItem( 'Menu' );
        $this->add( '/menu/moveup/@id', 'GET', array(
            'controller' => 'Menu',
            'action' => 'moveUp' 
        ) );
        
       
        
        $this->add( '/menu/movedown/@id', 'GET', array(
            'controller' => 'Menu',
            'action' => 'moveDown' 
        ) );
        
        $this->add( '/menu/publishtoggle/@id', 'POST', array(
        		'controller' => 'Menu',
        		'action' => 'togglePublish'
        ) );
        $this->add( '/cache/opcache', 'GET', array(
            'namespace' => '\Admin\Controllers\Cache',
            'controller' => 'OpCache',
            'action' => 'index'
        ) );
        
        $this->add( '/cache/opcache/reset', 'GET', array(
            'namespace' => '\Admin\Controllers\Cache',
            'controller' => 'OpCache',
            'action' => 'reset'
        ) );
        
        $this->add( '/cache/opcache/invalidate', 'GET', array(
            'namespace' => '\Admin\Controllers\Cache',
            'controller' => 'OpCache',
            'action' => 'invalidate'
        ) );

        $this->add( '/cache/apcu', 'GET', array(
            'namespace' => '\Admin\Controllers\Cache',
            'controller' => 'Apcu',
            'action' => 'index'
        ) );

        $this->add( '/cache/apcu/reset', 'GET', array(
            'namespace' => '\Admin\Controllers\Cache',
            'controller' => 'Apcu',
            'action' => 'reset'
        ) );
        
        $this->add( '/cache/apcu/invalidate', 'GET', array(
            'namespace' => '\Admin\Controllers\Cache',
            'controller' => 'Apcu',
            'action' => 'invalidate'
        ) );

        $this->add( '/cache/apcu/read', 'GET', array(
            'namespace' => '\Admin\Controllers\Cache',
            'controller' => 'Apcu',
            'action' => 'read'
        ) );
        
        $this->add( '/cron', 'GET', array(
            'controller' => 'Cron',
            'action' => 'index'
        ) );
        
        $this->add( '/cron/enable/@hash', 'GET', array(
            'controller' => 'Cron',
            'action' => 'enable'
        ) );
        
        $this->add( '/cron/disable/@hash', 'GET', array(
            'controller' => 'Cron',
            'action' => 'disable'
        ) );
        
        $this->add( '/cron/delete/@hash', 'GET', array(
            'controller' => 'Cron',
            'action' => 'delete'
        ) );
        
        $this->add( '/cron/edit/@hash', 'GET', array(
            'controller' => 'Cron',
            'action' => 'edit'
        ) );
        
        $this->add( '/cron/edit/@hash', 'POST', array(
            'controller' => 'Cron',
            'action' => 'save'
        ) );
        
        $this->add( '/cron/create', 'GET', array(
            'controller' => 'Cron',
            'action' => 'create'
        ) );
        
        $this->add( '/trash/items', 'GET', array(
        		'controller' => 'TrashItems',
        		'action' => 'index'
        ) );
        $this->add( '/trash/item/delete/@id', 'GET|POST', array(
        		'controller' => 'TrashItem',
        		'action' => 'delete'
        ) );
        
        $this->add( '/trash/item/restore/@id', 'GET|POST', array(
        		'controller' => 'TrashItem',
        		'action' => 'restore'
        ) );
        
        /**
         * Languages
         */
        $this->addCrudGroup( 'Languages', 'Language' );
        $this->add('/languages/moveUp/@id', 'GET', array(
            'controller' => 'Languages',
            'action' => 'MoveUp'
        ));
        $this->add('/languages/moveDown/@id', 'GET', array(
            'controller' => 'Languages',
            'action' => 'MoveDown'
        ));
        
        /**
         * Languages
        */
        $this->add('/language/@id/strings', 'GET', array(
            'controller' => 'Language',
            'action' => 'strings'
        ));
        $this->add('/language/@id/strings', 'POST', array(
            'controller' => 'Language',
            'action' => 'stringsUpdate'
        ));
        $this->add('/language/@id/keys/create [ajax]', 'POST', array(
            'controller' => 'Language',
            'action' => 'createKey'
        ));
    }
}