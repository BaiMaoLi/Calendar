<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">

    <title>Calendar | Remark Material Admin Template</title>

    <link rel="apple-touch-icon" href="../../../assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="../../../assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../../../../global/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../../global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="../../../assets/css/site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="../../../../global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="../../../../global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="../../../../global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="../../../../global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="../../../../global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="../../../../global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="../../../../global/vendor/waves/waves.css">
    <link rel="stylesheet" href="../../../../global/vendor/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="../../../../global/vendor/bootstrap-datepicker/bootstrap-datepicker.css">
    <link rel="stylesheet" href="../../../../global/vendor/bootstrap-touchspin/bootstrap-touchspin.css">
    <link rel="stylesheet" href="../../../../global/vendor/jquery-selective/jquery-selective.css">
    <link rel="stylesheet" href="../../../assets/examples/css/apps/calendar.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="../../../../global/fonts/material-design/material-design.min.css">
    <link rel="stylesheet" href="../../../../global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>


    <link rel="stylesheet" href="../../../assets/css/custom.css">


    <!--[if lt IE 9]>
    <script src="../../../../global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="../../../../global/vendor/media-match/media.match.min.js"></script>
    <script src="../../../../global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="../../../../global/vendor/breakpoints/breakpoints.js"></script>
    <script>
        Breakpoints();
    </script>
</head>
<body class="animsition app-calendar page-aside-left">
<!--<body class="app-calendar page-aside-left">-->

    <?php echo $this->render('layouts/header.htm',NULL,get_defined_vars(),0); ?>

    <div class="page">
        <div class="page-aside">
            <div class="page-aside-switch">
                <i class="icon md-chevron-left" aria-hidden="true"></i>
                <i class="icon md-chevron-right" aria-hidden="true"></i>
            </div>
            <div class="page-aside-inner page-aside-scroll">
                <div data-role="container">
                    <div data-role="content">
                        <section class="page-aside-section">
                            <h5 class="page-aside-title">CALENDAR LIST</h5>
                            <div class="list-group has-actions">
                                <div class="list-group-item" data-plugin="editlist">
                                    <div class="list-content">
                                        <span class="item-right">10</span>
                                        <span class="list-text">Admin Calendar</span>
                                        <div class="item-actions">
                                            <span class="btn btn-pure btn-icon" data-toggle="list-editable"><i
                                                        class="icon md-edit" aria-hidden="true"></i></span>
                                            <span class="btn btn-pure btn-icon" data-toggle="list-delete"><i
                                                        class="icon md-delete" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <div class="list-editable">
                                        <div class="form-group form-material">
                                            <input type="text" class="form-control empty" name="label"
                                                   value="Admin Calendar">
                                            <button type="button" class="input-editable-close icon md-close"
                                                    data-toggle="list-editable-close"
                                                    aria-label="Close" aria-expanded="true"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item" data-plugin="editlist">
                                    <div class="list-content">
                                        <span class="item-right">5</span>
                                        <span class="list-text">Home Calendar</span>
                                        <div class="item-actions">
                                            <span class="btn btn-pure btn-icon" data-toggle="list-editable"><i
                                                        class="icon md-edit" aria-hidden="true"></i></span>
                                            <span class="btn btn-pure btn-icon" data-toggle="list-delete"><i
                                                        class="icon md-delete" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <div class="list-editable">
                                        <div class="form-group form-material">
                                            <input type="text" class="form-control empty" name="label"
                                                   value="Home Calendar">
                                            <button type="button" class="input-editable-close icon md-close"
                                                    data-toggle="list-editable-close"
                                                    aria-label="Close" aria-expanded="true"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item" data-plugin="editlist">
                                    <div class="list-content">
                                        <span class="item-right">16</span>
                                        <span class="list-text">Work Calendar</span>
                                        <div class="item-actions">
                                            <span class="btn btn-pure btn-icon" data-toggle="list-editable"><i
                                                        class="icon md-edit" aria-hidden="true"></i></span>
                                            <span class="btn btn-pure btn-icon" data-toggle="list-delete"><i
                                                        class="icon md-delete" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <div class="list-editable">
                                        <div class="form-group form-material">
                                            <input type="text" class="form-control empty" name="label"
                                                   value="Work Calendar">
                                            <button type="button" class="input-editable-close icon md-close"
                                                    data-toggle="list-editable-close"
                                                    aria-label="Close" aria-expanded="true"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group-item" data-plugin="editlist">
                                    <div class="list-content">
                                        <span class="item-right">30</span>
                                        <span class="list-text">Calendar One</span>
                                        <div class="item-actions">
                                            <span class="btn btn-pure btn-icon" data-toggle="list-editable"><i
                                                        class="icon md-edit" aria-hidden="true"></i></span>
                                            <span class="btn btn-pure btn-icon" data-toggle="list-delete"><i
                                                        class="icon md-delete" aria-hidden="true"></i></span>
                                        </div>
                                    </div>
                                    <div class="list-editable">
                                        <div class="form-group form-material">
                                            <input type="text" class="form-control empty" name="label" value="Calendar One">
                                            <button type="button" class="input-editable-close icon md-close"
                                                    data-toggle="list-editable-close"
                                                    aria-label="Close" aria-expanded="true"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="page-aside-section">
                            <h5 class="page-aside-title">EVENTS</h5>
                            <div class="list-group calendar-list">
                                <?php foreach (($notscheduled?:[]) as $item): ?>
                                    <a class="list-group-item calendar-event" data-title="<?= ($item['TITLE']) ?>" data-stick=true
                                       data-color="<?= ($item['COLOR']) ?>" href="javascript:void(0)" data-idAPPOINTMENT="<?= ($item['idAPPOINTMENT']) ?>"
                                       data-FIRSTNAME="<?= ($item['FIRSTNAME']) ?>" data-LASTNAME="<?= ($item['LASTNAME']) ?>" data-EMAIL="<?= ($item['EMAIL']) ?>" data-PHONE="<?= ($item['PHONE']) ?>"
                                       data-idPRODUCT_CATEGORIE="<?= ($item['idPRODUCT_CATEGORIE']) ?>" data-duration="<?= ($item['DURATION']) ?>"
                                    >
                                        <i class="md-circle mr-10" style="color:<?= ($item['COLOR']) ?>" aria-hidden="true"></i><?= ($item['TITLE'])."
" ?>
                                    </a>
                                <?php endforeach; ?>
                                <a id="addNewEventBtn" class="list-group-item" href="javascript:void(0)">
                                    <i class="icon md-plus" aria-hidden="true"></i> Add New Event
                                </a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-main">
            <div class="calendar-container">
                <div id="calendar"></div>

                <!--AddEvent Dialog -->
                <div class="modal fade" id="addNewEvent" aria-hidden="true" aria-labelledby="addNewEvent"
                     role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-simple">
                        <form class="modal-content form-horizontal" action="<?= ($BASE) ?>/add_appointment" method="post" role="form" id="addNewEventForm">
                            <div class="modal-header">
                                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                                <h4 class="modal-title">New Event</h4>
                            </div>

                            <div class="alert alert-success event-success-message" role="alert">
                                This is a success alert—check it out!
                            </div>
                            <div class="alert alert-danger event-danger-message" role="alert">
                                Sorry. Someting is wrong.
                            </div>

                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="title">Title:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="title" name="title" required>
                                        <span class="validate-message">Event Title is Required</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="details">Details:</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" id="details" name="details" required rows="3"></textarea>
                                        <span class="validate-message">Detail is Required</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="category">Select Category:</label>
                                    <div class="col-md-10">
                                        <select class="form-control" id="category" name="category" required>
                                            <option value="-1" disabled selected>
                                                Please Select Event Category
                                            </option>
                                            <?php foreach (($event_categories?:[]) as $item): ?>
                                                <option value="<?= ($item['idCATEGORIE_APPOINTMENT']) ?>-<?= ($item['COLOR']) ?>-<?= ($item['DURATION']) ?>">
                                                    <?= ($item['NAME']) ?>(<?= ($item['DURATION']) ?>mins)
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <span class="validate-message">Category is Required</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="first_name">First Name:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                                        <span class="validate-message">First Name is Required</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="last_name">Last Name:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                                        <span class="validate-message">Last Name is Required</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="phone">Phone:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="phone" name="phone" required>
                                        <span class="validate-message">Phone is Required</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="repeats">Repeats:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="repeats" name="repeats"
                                               data-plugin="TouchSpin"
                                               data-min="0" data-max="10" value="1"/>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <div class="form-actions">
                                    <button class="btn btn-primary" type="button" id="SubmitAddEventForm">Add this event</button>
                                    <a class="btn btn-sm btn-white btn-pure" data-dismiss="modal" href="javascript:void(0)">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End AddEvent Dialog -->

                <!-- Edit Dialog -->
                <div class="modal fade" id="editNewEvent" aria-hidden="true" aria-labelledby="editNewEvent"
                     role="dialog" tabindex="-1" data-show="false">
                    <div class="modal-dialog modal-simple">
                        <form class="modal-content form-horizontal" action="<?= ($BASE) ?>/update_slot" id="editEventForm" method="post" role="form">
                            <div class="modal-header">
                                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                                <h4 class="modal-title">Edit Event</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-success event-success-message" role="alert">
                                    This is a success alert—check it out!
                                </div>
                                <div class="alert alert-danger event-danger-message" role="alert">
                                    Sorry. Someting is wrong.
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="duration">Duration(mins):</label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control" id="duration" name="duration">
                                    </div>
                                </div>
                                <input type="hidden" id="idAppoint" name="idAPPOINTMENT">
                                <input type="hidden" id="idSlot" name="idSlot">
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="editStarts">Starts:</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="editStarts" name="editStarts"
                                                   data-container="#editNewEvent"
                                                   data-plugin="datepicker">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="icon md-calendar" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="editEnds">Ends:</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="editEnds"
                                                   data-container="#editNewEvent"
                                                   data-plugin="datepicker" name="editEnds">
                                            <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="icon md-calendar" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="editRepeats">Repeats:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="editRepeats" name="repeats"
                                               data-plugin="TouchSpin"
                                               data-min="0" data-max="10" value="0"/>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <div class="form-actions">
                                    <button class="btn btn-primary" type="button" id="event-update">Save</button>
                                    <button class="btn btn-danger" data-dismiss="modal" type="button">Delete</button>
                                    <a class="btn btn-sm btn-white btn-pure" data-dismiss="modal" href="javascript:void(0)">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End EditEvent Dialog -->

                <!--AddCalendar Dialog -->
                <div class="modal fade" id="addNewCalendar" aria-hidden="true" aria-labelledby="addNewCalendar"
                     role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-simple">
                        <form class="modal-content form-horizontal" action="#" method="post" role="form">
                            <div class="modal-header">
                                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                                <h4 class="modal-title">New Calendar</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="ename">Name:</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="ename" name="ename">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="form-control-label col-md-2">Color:</label>
                                    <div class="col-md-10">
                                        <ul class="color-selector">
                                            <li class="bg-blue-600">
                                                <input type="radio" checked name="colorChosen" id="colorChosen2">
                                                <label for="colorChosen2"></label>
                                            </li>
                                            <li class="bg-green-600">
                                                <input type="radio" name="colorChosen" id="colorChosen3">
                                                <label for="colorChosen3"></label>
                                            </li>
                                            <li class="bg-cyan-600">
                                                <input type="radio" name="colorChosen" id="colorChosen4">
                                                <label for="colorChosen4"></label>
                                            </li>
                                            <li class="bg-orange-600">
                                                <input type="radio" name="colorChosen" id="colorChosen5">
                                                <label for="colorChosen5"></label>
                                            </li>
                                            <li class="bg-red-600">
                                                <input type="radio" name="colorChosen" id="colorChosen6">
                                                <label for="colorChosen6"></label>
                                            </li>
                                            <li class="bg-blue-grey-600">
                                                <input type="radio" name="colorChosen" id="colorChosen7">
                                                <label for="colorChosen7"></label>
                                            </li>
                                            <li class="bg-purple-600">
                                                <input type="radio" name="colorChosen" id="colorChosen8">
                                                <label for="colorChosen8"></label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-2 form-control-label" for="people">People:</label>
                                    <div class="col-md-10">
                                        <select id="people" multiple="multiple" class="plugin-selective"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="form-actions">
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">Create</button>
                                    <a class="btn btn-sm btn-white btn-pure" data-dismiss="modal" href="javascript:void(0)">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End AddCalendar Dialog -->
            </div>
        </div>
    </div>

    <!-- Site Action -->
    <div class="site-action" data-plugin="actionBtn">
        <button type="button" class="site-action-toggle btn-raised btn btn-success btn-floating">
            <i class="front-icon md-plus animation-scale-up" aria-hidden="true"></i>
            <i class="back-icon md-delete animation-scale-up" aria-hidden="true"></i>
        </button>
    </div>
    <!-- End Site Action -->

    <!-- Add Calendar Form -->
    <div class="modal fade" id="addNewCalendarForm" aria-hidden="true" aria-labelledby="addNewCalendarForm"
         role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
            <form class="modal-content" action="#" method="post" role="form">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Create New Calendar</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-control-label mb-15" for="name">Calendar name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Calendar name">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label mb-15" for="name">Choice people to your project:</label>
                        <select multiple="multiple" class="plugin-selective"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <button class="btn btn-primary" data-dismiss="modal" type="button">Create</button>
                        <a class="btn btn-sm btn-white btn-pure" data-dismiss="modal" href="javascript:void(0)">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Add Calendar Form -->


    <!-- Footer -->
    <footer class="site-footer">
        <div class="site-footer-legal">© 2018 <a
                    href="http://themeforest.net/item/remark-responsive-bootstrap-admin-template/11989202">Remark</a></div>
        <div class="site-footer-right">
            Crafted with <i class="red-600 icon md-favorite"></i> by <a href="https://themeforest.net/user/creation-studio">Creation
                Studio</a>
        </div>
    </footer>
    <!-- Core  -->
    <script src="../../../../global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
    <script src="../../../../global/vendor/jquery/jquery.js"></script>
    <script src="../../../../global/vendor/popper-js/umd/popper.min.js"></script>
    <script src="../../../../global/vendor/bootstrap/bootstrap.js"></script>
    <script src="../../../../global/vendor/animsition/animsition.js"></script>
    <script src="../../../../global/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="../../../../global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
    <script src="../../../../global/vendor/asscrollable/jquery-asScrollable.js"></script>
    <script src="../../../../global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
    <script src="../../../../global/vendor/waves/waves.js"></script>

    <script src="../../../assets/js/Custom/EventOperation.js"></script>


    <!-- Plugins -->
    <script src="../../../../global/vendor/switchery/switchery.js"></script>
    <script src="../../../../global/vendor/intro-js/intro.js"></script>
    <script src="../../../../global/vendor/screenfull/screenfull.js"></script>
    <script src="../../../../global/vendor/slidepanel/jquery-slidePanel.js"></script>
    <script src="../../../../global/vendor/jquery-ui/jquery-ui.min.js"></script>
    <script src="../../../../global/vendor/moment/moment.min.js"></script>
    <script src="../../../../global/vendor/fullcalendar/fullcalendar.js"></script>
    <script src="../../../../global/vendor/jquery-selective/jquery-selective.min.js"></script>
    <script src="../../../../global/vendor/bootstrap-datepicker/bootstrap-datepicker.js"></script>
    <script src="../../../../global/vendor/bootstrap-touchspin/bootstrap-touchspin.min.js"></script>
    <script src="../../../../global/vendor/bootbox/bootbox.js"></script>

    <!-- Scripts -->
    <script src="../../../../global/js/Component.js"></script>
    <script src="../../../../global/js/Plugin.js"></script>
    <script src="../../../../global/js/Base.js"></script>
    <script src="../../../../global/js/Config.js"></script>

    <script src="../../../assets/js/Section/Menubar.js"></script>
    <script src="../../../assets/js/Section/Sidebar.js"></script>
    <script src="../../../assets/js/Section/PageAside.js"></script>
    <script src="../../../assets/js/Plugin/menu.js"></script>

    <!-- Config -->
    <script src="../../../../global/js/config/colors.js"></script>
    <script src="../../../assets/js/config/tour.js"></script>
    <script>Config.set('assets', '../../../assets');</script>

    <!-- Page -->
    <script src="../../../assets/js/Site.js"></script>
    <script src="../../../../global/js/Plugin/asscrollable.js"></script>
    <script src="../../../../global/js/Plugin/slidepanel.js"></script>
    <script src="../../../../global/js/Plugin/switchery.js"></script>
    <script src="../../../../global/js/Plugin/bootstrap-touchspin.js"></script>
    <script src="../../../../global/js/Plugin/bootstrap-datepicker.js"></script>
    <script src="../../../../global/js/Plugin/material.js"></script>
    <script src="../../../../global/js/Plugin/action-btn.js"></script>
    <script src="../../../../global/js/Plugin/editlist.js"></script>
    <script src="../../../../global/js/Plugin/bootbox.js"></script>
    <script src="../../../assets/js/Site.js"></script>
    <script src="../../../assets/js/App/Calendar.js"></script>
    <script src="../../../assets/examples/js/apps/calendar.js"></script>





</body>
</html>
