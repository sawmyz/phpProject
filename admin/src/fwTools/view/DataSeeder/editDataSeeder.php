<?php
$View = new View('Data Seeder');
$Data = $View->getData()->cols;
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DATA SEEDER</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="../../index.php">خانه</a></li>
                    <li class="breadcrumb-item active">DATA SEEDER</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">

        <div class="col-md-12">
            <div class="card card-danger card-outline">
                <form>
                    <div class="card-header">
                        <h3 class="card-title">DATA SEEDER</h3>
                        <div class="card-tools">

                            <a rel="DataSeeder/DataSeeder.fwTools"
                               class="btn btn-outline-danger mr-2 pull-left ajax"><i
                                        class="fa fa-arrow-left"></i> بازگشت </a>
                            <a rel="DataSeeder/editDataSeeder.fwTools?table=<?= $View->getData()->table ?>"
                               class="btn btn-outline-danger pull-left ajax"><i
                                        class="fa fa-refresh"></i> تازه
                                سازی</a>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-wrap table-responsive">
                        <?= hiddenInput($View->getData()->table, 'table') ?>
                        <?= controllerType('submit') ?>
                        <?php
                        foreach ($Data as $item) {
                            ?>
                            <div class="form-group col-md-4">
                                <label ><?= $item->name?></label>
                                <select required class="form-control" name="name[<?= $item->name ?>]">
                                    <option value="0" selected>خالی باشد</option>
                                    <option value="state">آیدی استان</option>
                                    <option value="state_name">نام استان</option>
                                    <option value="city">آیدی شهر</option>
                                    <option value="city_name">نام شهر</option>
                                    <option value="state_by_city">آیدی استان والد شهر</option>
                                    <option value="mobile">موبایل</option>
                                    <option value="fname">نام</option>
                                    <option value="lname">نام خانوادگی</option>
                                    <option value="tel">تلفن</option>
                                    <option value="username">نام کاربری</option>
                                    <option value="password">رمز عبور</option>
                                    <option value="nCode">کد ملی</option>
                                    <option value="email">ایمیل</option>
                                    <option value="word">کلمه</option>
                                    <option value="time">تایم الان</option>
                                </select>
                            </div>
                            <?
                        }
                        ?>
                        <div class="form-group col-md-9 mr-auto ml-auto">
                            <label>تعداد رکورد ها</label>
                            <input type="text" style="text-align: center" min="1" value="50" maxlength="3" name="count" id="count" required
                                   class="form-control">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" name="submit" class="btn btn-danger pull-left"><i class="fa fa-plus"></i>
                            !Seed
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $("#count").checkNumber({
        max: 3
    });
    $.submit('fwTools/controller/DataSeeder/DataSeeder')
</script>