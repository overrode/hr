<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <main class="container track_bg">
        <div class="row">
            <div class="col-lg-12 col-md-12- colxs-12">
                <div class="col-md-6" id='calendar'></div>
                <div class="col-md-6">
                    <form action="" method="post">
                        <!--Project-->
                        <label>Project</label>
                        <div class=" margin_bottom">
                            <input id="form_project" type="text" class="form-control" name="project" value=""  rows="3">
                        </div>
                        <!--Task-->
                        <label>Task</label>
                        <div class=" margin_bottom">
                            <input id="form_task" type="text" class="form-control" name="task" value="" rows="3">
                        </div>
                        <!--Details-->
                        <label>Details</label>
                        <div class=" margin_bottom">
                            <textarea id="form_details" type="text" class="form-control" name="details" value="" rows="3"></textarea>
                        </div>
                        <!--Hours-->
                        <label>Hours</label>
                        <div class=" margin_bottom">
                            <input id="form_hours" type="number" class="form-control" name="hours" value="" >
                        </div>
                        <!--Date-->
                        <label>Date</label>
                        <div class=" margin_bottom">
                            <input id="form_date" type="date" class="form-control"  name="date"  value="" disabled >
                        </div>
                        <button class="login_home btn btn-info btn-block login" name="submit_work">SAVE</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-12 col-md-12- col-xs-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Project</th>
                        <th>Task</th>
                        <th>Hours</th>
                        <th>Details</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo "HR"; ?></td>
                        <td><?php echo "Calendar"; ?></td>
                        <td><?php echo "8"; ?></td>
                        <td><?php echo "Implement calendar functionality"; ?></td>
                        <td><?php echo "2017-03-21"; ?></td>
                        <td><button class="btn btn-danger">EDIT</button></td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </main>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>