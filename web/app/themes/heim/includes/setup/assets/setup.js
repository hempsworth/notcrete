(function($) {
    
	'use strict';
    
    function Heim_Theme_Setup() {
        var self = this;
        
        // Form button callbacks
        self.callbacks = {
            do_next_step: function(btn) {
                self.stepShowNext(btn);
            },
            plugins_install: function(btn) {
                self.pluginsInstall();
            },
            content_install: function(btn) {
                self.contentInstall();
            }
        };
        
        self.init();
    }
    
    Heim_Theme_Setup.prototype = {
        /**
         * Initialize
         */
        init: function() {
            var self = this;
            
            // Show initial step
            $('.heim-setup-step:first').addClass('active');

            // Bind: Setup buttons
            $('.heim-setup-button').on('click', function(e) {
                e.preventDefault();
                self.setupNoticeHide();
                $('.heim-setup-view').addClass('loading');
                self.callbacks[$(this).data('callback')](this);
            });
        },
        
        /**
         * Setup notice: Show
         */
        setupNoticeShow( notice, type ) {
            var $notice = $('#heim-setup-notice');
            $notice.children('p').html('Setup error: '+notice);
            $notice.removeClass().addClass('notice notice-'+type);
            
            console.log('Heim Setup - '+notice);
        },
        
        /**
         * Setup notice: Hide
         */
        setupNoticeHide() {
            $('#heim-setup-notice').addClass('hide');
        },
        
        /**
         * Step: Show next step
         */
        stepShowNext: function(btn) {
            var self = this;
            
            setTimeout(function() {
                // Set active step
                var $stepActive = $('.heim-setup-steps').children('.active');
                $stepActive.removeClass('active');
                $stepActive.next().addClass('active');
                
                // Hide loader
                self.stepHideLoader();
            }, 250);
        },
        
        /**
         * Step: Hide "loader"
         */
        stepHideLoader: function() {
            $('.heim-setup-view').removeClass('loading');
        },
        
        /**
         * Plugins: Install
         */
        pluginsInstall: function() {
            var self = this;
            
            var $pluginList = $('.heim-setup-tasks-plugins'),
                $currentPlugin;
            
            /* Callback for plugin installation AJAX request */
            var _ajaxCallback = function(response) {
                if (typeof response == 'object' && typeof response.data != 'undefined') {
                    $currentPlugin.find('span').text(response.data);
                }
                
                _installNextPlugin();
            };
            
            /* Install next plugin in list */
            var _installNextPlugin = function() {
                $pluginList.children('li').each(function() {
                    $currentPlugin = $(this);
                
                    if ($pluginList.children('li').not('.processed').length == 0) {
                        // Done with all plugins
                        setTimeout(function() {
                            self.stepShowNext();
                        }, 500);
                        return false; // Break loop
                    }
                    
                    if (! $currentPlugin.hasClass('processed')) {
                        $currentPlugin.addClass('processed');
                        
                        // Skip plugin if it's already activated
                        if ($currentPlugin.data('status') === 'activated') {
                            _installNextPlugin();
                            return false; // Break loop
                        }
                        
                        $currentPlugin.find('span').text('Processing…');
                        
                        $.post(heim_setup_data.ajaxurl, {
                            action: 'plugin_install',
                            dataType: 'json',
                            wpnonce: heim_setup_data.wpnonce,
                            plugin: $currentPlugin.data('plugin')
                        }, _ajaxCallback).fail(_ajaxCallback);
                        
                        return false; // Break loop
                    }
                });
            };
            
            // Start installing plugins
            _installNextPlugin();
        },
        
        /**
         * Content: Install
         */
        contentInstall: function() {
            var self = this,
                installationTasks = heim_setup_data.importtasks;
            
            /* Get first/next task from installationTasks object */
            var _taskGet = function() {
                for (var task in installationTasks) {
                    if (installationTasks.hasOwnProperty(task)) {
                        return [task, installationTasks[task]];
                    }
                }
                return null;
            };
            
            /* Set progress message */
            var _taskSetProgressMessage = function(message) {
                var $taskElement = $('.heim-setup-task-content');
                $taskElement.find('span').html(message);
            };

            /* AJAX Callback */
            var _taskDebugCallback = function(taskComplete, taskResponse) {
                console.log('Heim Setup - Task ended: '+taskComplete);
                if (taskResponse.length > 0) {
                    console.log('Heim Setup - Task "'+taskComplete+'" response: '+taskResponse);
                }
            };
            
            /* AJAX: Do installation task */
            var _taskDoIntall = function(taskSlug, taskMessage) {
                $.ajax({
                    type: 'POST',
                    url: heim_setup_data.ajaxurl,
                    data: {
                        action: 'content_install',
                        wpnonce: heim_setup_data.wpnonce,
                        task: taskSlug
                    },
                    beforeSend: function() {
                        _taskSetProgressMessage(taskMessage + '…');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        self.setupNoticeShow('_taskDoIntall > ' + taskSlug + ': '+errorThrown, 'error');
                        self.stepHideLoader();
                        _taskSetProgressMessage('<em class="error">Failed, please try again</em>');
                    },
                    success: function(response) {
                        _taskSetProgressMessage('Done', true);
                        
                        _taskDebugCallback(taskSlug, response);
                        
                        // Delete completed task from installationTasks object
                        delete installationTasks[taskSlug];
                        
                        // Do next task
                        var nextTask = _taskGet();
                        if (nextTask) {
                            _taskDoIntall(nextTask[0], nextTask[1].progressMessage);
                        } else {
                            // All tasks done, go to next step
                            self.stepShowNext();
                        }
                    }
                });
            };
            
            // Do first task
            var task = _taskGet();
            
            _taskDoIntall(task[0], task[1].progressMessage);
        }
    };
    
    $(function() { // Doc ready
		new Heim_Theme_Setup();
	});
	
})(jQuery);