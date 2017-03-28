<?php @include APP_PATH . 'view/snippets/header.tpl.php';

/**
 * @var array $form_errors
 *
**/
?>
    <main class="container track_bg">
        <div class="row">
            <div class="col-lg-12 col-md-12- col-xs-12">
                <div class="col-md-6 col-xs-6" id='calendar'></div>
                <div class="col-md-5 col-xs-5 col-md-offset-1">
                    <form action="<?php echo APP_URL; ?>/track/add" method="post">
                        <!--Project-->
                        <label>Project</label>
                            <input id="form_project" type="text" class="form-control <?php echo ($form_errors['errorProject']) ? "errorClass" : "" ?>"
                                   name="project" value="<?php echo $_POST['project']; ?>">
                        <!--Task-->
                        <label>Task</label>
                            <input id="form_task" type="text" class="form-control <?php echo ($form_errors['errorTask']) ? "errorClass" : "" ?>" name="task" value="<?php echo $_POST['task']; ?>">
                        <!--Details-->
                        <label>Details</label>
                            <textarea id="form_details" type="text" class="form-control <?php echo ($form_errors['errorDetails']) ? "errorClass" : "" ?>" name="details" rows="3" ><?php echo $_POST['details']; ?></textarea>
                        <!--Hours-->
                        <label>Hours</label>
                        <input id="form_hours" type="text" class="numbersOnly form-control  <?php echo ($form_errors['errorHours']) ? "errorClass" : "" ?>" name="hours" value="<?php echo $_POST['hours']; ?>">
                        <input type="hidden" id="form_job_entry_id" name="id_work" >
                        <!--Date-->
                        <label>Date</label>
                            <input id="form_date" type="text" class="form-control  <?php echo ($form_errors['errorDate']) ? "errorClass" : "" ?>"  name="date"  value="" readonly>
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