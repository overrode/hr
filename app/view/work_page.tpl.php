<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <main class="container track_bg">
        <div class="row">
            <div class="col-lg-12 col-md-12- col-xs-12">
                <div class="col-md-6 col-xs-6" id='calendar'></div>
                <div class="col-md-5 col-xs-5 col-md-offset-1">
                    <form action="<?php echo APP_URL; ?>/track/add" method="post">
                        <!--Project-->
                        <label>Project</label>
                            <input id="form_project" type="text" class="form-control" name="project" value="">
                        <!--Task-->
                        <label>Task</label>
                            <input id="form_task" type="text" class="form-control" name="task" value="">
                        <!--Details-->
                        <label>Details</label>
                            <textarea id="form_details" type="text" class="form-control" name="details" value="" rows="3"></textarea>
                        <!--Hours-->
                        <label>Hours</label>
                            <input id="form_hours" type="number" class="form-control" name="hours" value="" >
                        <!--Date-->
                        <label>Date</label>
                            <input id="form_date" type="text" class="form-control"  name="date"  value="" disabled >
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
                    <tbody id="work_list">
                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>