<?php @include APP_PATH . 'view/snippets/header.tpl.php';

/**
 * @var array $form_errors
 *
**/
?>
    <main class="container track_bg">
        <div id="success_modify_1" class="col-md-4 center-block">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" id="x_close">×</a>
            <p id="success_modify_2"></p>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12- col-xs-12">
                <div class="col-md-6 col-xs-6" id='calendar'></div>
                <div class="col-md-5 col-xs-5 col-md-offset-1">
                    <form id="form_submit_work" action="<?php echo APP_URL; ?>/track/add" method="post">
                        <!--Project-->
                        <label>Project</label>
                        <label id="label_project"></label>
                            <input id="form_project" type="text" class="form-control" name="project" value="<?php echo $_POST['project']; ?>" title="Project">
                        <!--Task-->
                        <label>Task</label>
                        <label id="label_task"></label>
                            <input id="form_task" type="text" class="form-control" name="task" value="<?php echo $_POST['task']; ?>" title="Task">
                        <!--Details-->
                        <label>Details</label>
                        <label id="label_details"></label>
                            <textarea id="form_details" type="text" class="form-control" name="details" rows="3" title="Details"><?php echo $_POST['details']; ?></textarea>
                        <!--Hours-->
                        <label>Hours</label>
                        <label id="label_hours"></label>
                        <input id="form_hours" type="text" class="form-control" name="hours" value="<?php echo $_POST['hours']; ?>" title="Hours">
                        <input type="hidden" id="form_job_entry_id" name="id_work" >
                        <!--Date-->
                        <label>Date</label>
                            <input id="form_date" type="text" class="form-control "  name="date"  value="" readonly title="Hidden ID">
                        <button class="login_home btn btn-info btn-block login" name="submit_work">SAVE</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-10 col-md-10- col-xs-12">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Project</th>
                        <th>Task</th>
                        <th>Hours</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody id="work_list" class="work_class">
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>