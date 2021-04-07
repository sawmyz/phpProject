<?php

use FwHtml\Elements\Attrs\Style\Props\FormMethod;
use FwHtml\Elements\Tags\Main\HtmlTags;


try {
    echo HtmlTags::Html('[lang=""]')
        ->Content(
            include 'layers/head.php',
            HtmlTags::Body('.hold-transition.login-page')
                ->Content(
                    HtmlTags::Div('.login-box')
                        ->Content(
                            HtmlTags::Div('.login-logo')
                                ->Content(
                                    HtmlTags::A('[href=index]')
                                        ->Content(
                                            HtmlTags::H4(
                                                " ورود به پنل مدیریت " . FwConfig::PROJECT_NAME()
                                            )
                                        )
                                ),
                            HtmlTags::Div('.card')
                                ->Content(
                                    HtmlTags::Div('.card-body.login-card-body')
                                        ->Content(
                                            (isset($_SESSION['admin_auth']['login']) and $_SESSION['admin_auth']['login'] == false)
                                                ? HtmlTags::P('.login-box-msg.label-danger')->Content(
                                                'نام کاربری یا رمز عبور اشتباه است'
                                            ) : HtmlTags::P('.login-box-msg')->Content(
                                                'فرم زیر را تکمیل کنید و ورود بزنید'
                                            ),
                                            HtmlTags::Form()
                                                ->Method(FormMethod::Post())
                                                ->Action('login')
                                                ->Content(
                                                    HtmlTags::Div('.input-group.mb-3')
                                                        ->Content(
                                                            HtmlTags::Input('.form-control')
                                                                ->Name($Auth::config()->__UserName)
                                                                ->PlaceHolder('نام کاربری'),
                                                            HtmlTags::Div('.input-group-append')
                                                                ->Content(
                                                                    HtmlTags::Span('.fa.fa-user.input-group-text')
                                                                )
                                                        ),
                                                    HtmlTags::Div('.input-group.mb-3')
                                                        ->Content(
                                                            HtmlTags::Input('.form-control')->Type('password')
                                                                ->Name($Auth::config()->__Password)
                                                                ->PlaceHolder('رمز عبور'),
                                                            HtmlTags::Div('.input-group-append')
                                                                ->Content(
                                                                    HtmlTags::Span('.fa.fa-lock.input-group-text')
                                                                )
                                                        ), // div.input-group
                                                    HtmlTags::Div('.row')
                                                        ->Content(
                                                            HtmlTags::Div('.col-8')
                                                                ->Content(
                                                                    HtmlTags::Div('.checkbox')
                                                                        ->Content(
                                                                            HtmlTags::Label('مرا به خاطر بسپار')
                                                                                ->Content(
                                                                                    HtmlTags::Input()
                                                                                        ->Type('checkbox')
                                                                                        ->Name('rememberMe')
                                                                                        ->Value('1')
                                                                                ) // label
                                                                        ) // div.checkbox
                                                                ), // div.col-8
                                                            HtmlTags::Div('.col-4')
                                                                ->Content(
                                                                    HtmlTags::Button('.btn.btn-primary.btn-block.btn-flat[name=submit][type=submit] ورود')
                                                                ) // div.col-4
                                                        ) // div.row
                                                ) // form
                                        ) // div.card-body
                                ) // div.card
                        ) // div.login-box
                ) // body
        );
} catch (
    ReflectionException $e) {
} catch (\fwPageHelper\Forms\Resources\FormException $e) {
}
