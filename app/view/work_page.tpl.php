<?php @include APP_PATH . 'view/snippets/header.tpl.php'; ?>

    <main class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12- colxs-12">
                <div class="col-md-6" id='calendar'></div>
                <div class="col-md-6">
                    <form action="" method="post" style="margin-top:50px;">
                        <!--Project-->
                        <div class=" margin_bottom">
                            <textarea type="text" class="form-control"  name="project" value=""  rows="2">Project</textarea>
                        </div>
                        <!--Task-->
                        <div class=" margin_bottom">
                            <input type="text" class="form-control" name="task" value="" placeholder="Task">
                        </div>
                        <!--Hours-->
                        <div class=" margin_bottom">
                            <input type="number" class="form-control" name="hours" value="" placeholder="Hours">
                        </div>
                        <!--Details-->
                        <div class=" margin_bottom">
                            <input type="text" class="form-control" name="details" value="" placeholder="Details">
                        </div>
                        <!--Date-->
                        <div class=" margin_bottom">
                            <input type="date" class="form-control"  name="date"  value="" disabled >
                        </div>
                        <button class="login_home btn btn-info btn-block login" name="submit_work">ADD</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-12 col-md-12- colxs-12">

            </div>
        </div>
    </main>

<?php @include APP_PATH . 'view/snippets/footer.tpl.php'; ?>