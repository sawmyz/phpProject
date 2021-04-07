<?php
if (!FwConfig::DARK_MODE()) {
    ?>
    <style>
        .fw-preloader {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            direction: ltr;
            right: 0;
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            z-index: 400;
            background: #ffffff7d;
            transition: .3s all ease;
        }

        .fw-preloader .fw-preloader-body {
            margin-top: -5%;
            text-align: center;
        }

        .fw-preloader .fw-preloader-body:before {
            content: '<?=FwConfig::PROJECT_NAME()?>';
            display: block;
            margin-bottom: 26px;
            font-family: Vazir, "Montserrat", sans-serif;
            font-size: 24px;
            line-height: 1;
            font-weight: 900;
            text-align: center;
            color: #29293a;
        }

        .fw-preloader.loaded {
            opacity: 0;
            visibility: hidden;
        }

        @supports (-webkit-background-clip: text) {
            .fw-preloader .fw-preloader-body:before {
                background: linear-gradient(to right, #642535 20%, #c9967f 40%, #ffec17 60%, #642535 80%);
                background-size: 200% auto;
                background-clip: text;
                text-fill-color: transparent;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        }

        .ie-10 .fw-preloader .fw-preloader-body:before,
        .ie-11 .fw-preloader .fw-preloader-body:before {
            color: #c9967f;
            background: none;
        }

        [data-x-mode="true"] .fw-preloader {
            display: none !important;
        }

        .fw-preloader-wrapper {
            display: inline-block;
            font-size: 0;
            position: relative;
            width: 50px;
            height: 50px;
        }

        .fw-preloader-wrapper.fw-small {
            width: 36px;
            height: 36px;
        }

        .fw-preloader-wrapper.fw-big {
            width: 64px;
            height: 64px;
        }

        .fw-preloader-wrapper.fw-active {
            -webkit-animation: fw-container-rotate 1568ms linear infinite;
            animation: fw-container-rotate 1568ms linear infinite;
        }

        @-webkit-keyframes fw-container-rotate {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes fw-container-rotate {
            to {
                transform: rotate(360deg);
            }
        }

        .fw-spinner-layer {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            border-color: #642535;
        }

        .fw-spinner-blue,
        .fw-spinner-blue-only {
            border-color: #642535;
        }

        .fw-spinner-red,
        .fw-spinner-red-only {
            border-color: #c9967f;
        }

        .fw-spinner-yellow,
        .fw-spinner-yellow-only {
            border-color: #ffec17;
        }

        .fw-spinner-green,
        .fw-spinner-green-only {
            border-color: #080ab4;
        }

        .fw-active .fw-spinner-layer.fw-spinner-blue {
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-blue-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-blue-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-spinner-layer.fw-spinner-red {
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-red-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-red-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-spinner-layer.fw-spinner-yellow {
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-yellow-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-yellow-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-spinner-layer.fw-spinner-green {
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-green-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-green-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-spinner-layer,
        .fw-active .fw-spinner-layer.fw-spinner-blue-only,
        .fw-active .fw-spinner-layer.fw-spinner-red-only,
        .fw-active .fw-spinner-layer.fw-spinner-yellow-only,
        .fw-active .fw-spinner-layer.fw-spinner-green-only {
            opacity: 1;
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        @-webkit-keyframes fw-animate-fill-unfill-rotate {
            12.5% {
                transform: rotate(135deg);
            }
            25% {
                transform: rotate(270deg);
            }
            37.5% {
                transform: rotate(405deg);
            }
            50% {
                transform: rotate(540deg);
            }
            62.5% {
                transform: rotate(675deg);
            }
            75% {
                transform: rotate(810deg);
            }
            87.5% {
                transform: rotate(945deg);
            }
            to {
                transform: rotate(1080deg);
            }
        }

        @keyframes fw-animate-fill-unfill-rotate {
            12.5% {
                transform: rotate(135deg);
            }
            25% {
                transform: rotate(270deg);
            }
            37.5% {
                transform: rotate(405deg);
            }
            50% {
                transform: rotate(540deg);
            }
            62.5% {
                transform: rotate(675deg);
            }
            75% {
                transform: rotate(810deg);
            }
            87.5% {
                transform: rotate(945deg);
            }
            to {
                transform: rotate(1080deg);
            }
        }

        @-webkit-keyframes fw-animate-blue-fade-in-out {
            from {
                opacity: 1;
            }
            25% {
                opacity: 1;
            }
            26% {
                opacity: 0;
            }
            89% {
                opacity: 0;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes fw-animate-blue-fade-in-out {
            from {
                opacity: 1;
            }
            25% {
                opacity: 1;
            }
            26% {
                opacity: 0;
            }
            89% {
                opacity: 0;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 1;
            }
        }

        @-webkit-keyframes fw-animate-red-fade-in-out {
            from {
                opacity: 0;
            }
            15% {
                opacity: 0;
            }
            25% {
                opacity: 1;
            }
            50% {
                opacity: 1;
            }
            51% {
                opacity: 0;
            }
        }

        @keyframes fw-animate-red-fade-in-out {
            from {
                opacity: 0;
            }
            15% {
                opacity: 0;
            }
            25% {
                opacity: 1;
            }
            50% {
                opacity: 1;
            }
            51% {
                opacity: 0;
            }
        }

        @-webkit-keyframes fw-animate-yellow-fade-in-out {
            from {
                opacity: 0;
            }
            40% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            75% {
                opacity: 1;
            }
            76% {
                opacity: 0;
            }
        }

        @keyframes fw-animate-yellow-fade-in-out {
            from {
                opacity: 0;
            }
            40% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            75% {
                opacity: 1;
            }
            76% {
                opacity: 0;
            }
        }

        @-webkit-keyframes fw-animate-green-fade-in-out {
            from {
                opacity: 0;
            }
            65% {
                opacity: 0;
            }
            75% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        @keyframes fw-animate-green-fade-in-out {
            from {
                opacity: 0;
            }
            65% {
                opacity: 0;
            }
            75% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        .fw-gap-patch {
            position: absolute;
            top: 0;
            left: 45%;
            width: 10%;
            height: 100%;
            overflow: hidden;
            border-color: inherit;
        }

        .fw-gap-patch .fw-circle {
            width: 1000%;
            left: -450%;
        }

        .fw-circle-clipper {
            display: inline-block;
            position: relative;
            width: 50%;
            height: 100%;
            overflow: hidden;
            border-color: inherit;
        }

        .fw-circle-clipper .fw-circle {
            width: 200%;
            height: 100%;
            border-width: 2px;
            /* STROKEWIDTH */
            border-style: solid;
            border-color: inherit;
            border-bottom-color: transparent !important;
            border-radius: 50%;
            -webkit-animation: none;
            animation: none;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
        }

        .fw-circle-clipper.fw-left .fw-circle {
            left: 0;
            border-right-color: transparent !important;
            transform: rotate(129deg);
        }

        .fw-circle-clipper.fw-right .fw-circle {
            left: -100%;
            border-left-color: transparent !important;
            transform: rotate(-129deg);
        }

        .fw-active .fw-circle-clipper.fw-left .fw-circle {
            /* duration: ARCTIME */
            -webkit-animation: fw-left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-circle-clipper.fw-right .fw-circle {
            /* duration: ARCTIME */
            -webkit-animation: fw-right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        @-webkit-keyframes fw-left-spin {
            from {
                transform: rotate(130deg);
            }
            50% {
                transform: rotate(-5deg);
            }
            to {
                transform: rotate(130deg);
            }
        }

        @keyframes fw-left-spin {
            from {
                transform: rotate(130deg);
            }
            50% {
                transform: rotate(-5deg);
            }
            to {
                transform: rotate(130deg);
            }
        }

        @-webkit-keyframes fw-right-spin {
            from {
                transform: rotate(-130deg);
            }
            50% {
                transform: rotate(5deg);
            }
            to {
                transform: rotate(-130deg);
            }
        }

        @keyframes fw-right-spin {
            from {
                transform: rotate(-130deg);
            }
            50% {
                transform: rotate(5deg);
            }
            to {
                transform: rotate(-130deg);
            }
        }

        #spinnerContainer.fw-cooldown {
            /* duration: SHRINK_TIME */
            -webkit-animation: fw-container-rotate 1568ms linear infinite, fw-fade-out 400ms cubic-bezier(0.4, 0, 0.2, 1);
            animation: fw-container-rotate 1568ms linear infinite, fw-fade-out 400ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        @-webkit-keyframes fw-fade-out {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        @keyframes fw-fade-out {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
<?php } else {
    ?>
    <style>
        .fw-preloader {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            direction: ltr;
        !important;
            right: 0;
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            z-index: 400;
            background: #212121b0;
            transition: .3s all ease;
        }

        .fw-preloader .fw-preloader-body {
            margin-top: -5%;
            text-align: center;
        }

        .fw-preloader .fw-preloader-body:before {
            content: '<?=FwConfig::PROJECT_NAME()?>';
            display: block;
            margin-bottom: 26px;
            font-family: Vazir, "Montserrat", sans-serif;
            font-size: 24px;
            line-height: 1;
            font-weight: 900;
            text-align: center;
            color: #29293a;
        }

        .fw-preloader.loaded {
            opacity: 0;
            visibility: hidden;
        }

        @supports (-webkit-background-clip: text) {
            .fw-preloader .fw-preloader-body:before {
                background: linear-gradient(to right, #ff5b61 20%, #c9967f 40%, #ffec17 60%, #642535 80%);
                background-size: 200% auto;
                background-clip: text;
                text-fill-color: transparent;
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
        }

        .ie-10 .fw-preloader .fw-preloader-body:before,
        .ie-11 .fw-preloader .fw-preloader-body:before {
            color: #c9967f;
            background: none;
        }

        [data-x-mode="true"] .fw-preloader {
            display: none !important;
        }

        .fw-preloader-wrapper {
            display: inline-block;
            font-size: 0;
            position: relative;
            width: 50px;
            height: 50px;
        }

        .fw-preloader-wrapper.fw-small {
            width: 36px;
            height: 36px;
        }

        .fw-preloader-wrapper.fw-big {
            width: 64px;
            height: 64px;
        }

        .fw-preloader-wrapper.fw-active {
            -webkit-animation: fw-container-rotate 1568ms linear infinite;
            animation: fw-container-rotate 1568ms linear infinite;
        }

        @-webkit-keyframes fw-container-rotate {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes fw-container-rotate {
            to {
                transform: rotate(360deg);
            }
        }

        .fw-spinner-layer {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            border-color: #642535;
        }

        .fw-spinner-blue,
        .fw-spinner-blue-only {
            border-color: #642535;
        }

        .fw-spinner-red,
        .fw-spinner-red-only {
            border-color: #c9967f;
        }

        .fw-spinner-yellow,
        .fw-spinner-yellow-only {
            border-color: #ffec17;
        }

        .fw-spinner-green,
        .fw-spinner-green-only {
            border-color: #080ab4;
        }

        .fw-active .fw-spinner-layer.fw-spinner-blue {
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-blue-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-blue-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-spinner-layer.fw-spinner-red {
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-red-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-red-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-spinner-layer.fw-spinner-yellow {
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-yellow-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-yellow-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-spinner-layer.fw-spinner-green {
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-green-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both, fw-animate-green-fade-in-out 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-spinner-layer,
        .fw-active .fw-spinner-layer.fw-spinner-blue-only,
        .fw-active .fw-spinner-layer.fw-spinner-red-only,
        .fw-active .fw-spinner-layer.fw-spinner-yellow-only,
        .fw-active .fw-spinner-layer.fw-spinner-green-only {
            opacity: 1;
            -webkit-animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-animate-fill-unfill-rotate 5332ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        @-webkit-keyframes fw-animate-fill-unfill-rotate {
            12.5% {
                transform: rotate(135deg);
            }
            25% {
                transform: rotate(270deg);
            }
            37.5% {
                transform: rotate(405deg);
            }
            50% {
                transform: rotate(540deg);
            }
            62.5% {
                transform: rotate(675deg);
            }
            75% {
                transform: rotate(810deg);
            }
            87.5% {
                transform: rotate(945deg);
            }
            to {
                transform: rotate(1080deg);
            }
        }

        @keyframes fw-animate-fill-unfill-rotate {
            12.5% {
                transform: rotate(135deg);
            }
            25% {
                transform: rotate(270deg);
            }
            37.5% {
                transform: rotate(405deg);
            }
            50% {
                transform: rotate(540deg);
            }
            62.5% {
                transform: rotate(675deg);
            }
            75% {
                transform: rotate(810deg);
            }
            87.5% {
                transform: rotate(945deg);
            }
            to {
                transform: rotate(1080deg);
            }
        }

        @-webkit-keyframes fw-animate-blue-fade-in-out {
            from {
                opacity: 1;
            }
            25% {
                opacity: 1;
            }
            26% {
                opacity: 0;
            }
            89% {
                opacity: 0;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes fw-animate-blue-fade-in-out {
            from {
                opacity: 1;
            }
            25% {
                opacity: 1;
            }
            26% {
                opacity: 0;
            }
            89% {
                opacity: 0;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 1;
            }
        }

        @-webkit-keyframes fw-animate-red-fade-in-out {
            from {
                opacity: 0;
            }
            15% {
                opacity: 0;
            }
            25% {
                opacity: 1;
            }
            50% {
                opacity: 1;
            }
            51% {
                opacity: 0;
            }
        }

        @keyframes fw-animate-red-fade-in-out {
            from {
                opacity: 0;
            }
            15% {
                opacity: 0;
            }
            25% {
                opacity: 1;
            }
            50% {
                opacity: 1;
            }
            51% {
                opacity: 0;
            }
        }

        @-webkit-keyframes fw-animate-yellow-fade-in-out {
            from {
                opacity: 0;
            }
            40% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            75% {
                opacity: 1;
            }
            76% {
                opacity: 0;
            }
        }

        @keyframes fw-animate-yellow-fade-in-out {
            from {
                opacity: 0;
            }
            40% {
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            75% {
                opacity: 1;
            }
            76% {
                opacity: 0;
            }
        }

        @-webkit-keyframes fw-animate-green-fade-in-out {
            from {
                opacity: 0;
            }
            65% {
                opacity: 0;
            }
            75% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        @keyframes fw-animate-green-fade-in-out {
            from {
                opacity: 0;
            }
            65% {
                opacity: 0;
            }
            75% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        .fw-gap-patch {
            position: absolute;
            top: 0;
            left: 45%;
            width: 10%;
            height: 100%;
            overflow: hidden;
            border-color: inherit;
        }

        .fw-gap-patch .fw-circle {
            width: 1000%;
            left: -450%;
        }

        .fw-circle-clipper {
            display: inline-block;
            position: relative;
            width: 50%;
            height: 100%;
            overflow: hidden;
            border-color: inherit;
        }

        .fw-circle-clipper .fw-circle {
            width: 200%;
            height: 100%;
            border-width: 4px;
            /* STROKEWIDTH */
            border-style: solid;
            border-color: inherit;
            border-bottom-color: transparent !important;
            border-radius: 50%;
            -webkit-animation: none;
            animation: none;
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
        }

        .fw-circle-clipper.fw-left .fw-circle {
            left: 0;
            border-right-color: transparent !important;
            transform: rotate(129deg);
        }

        .fw-circle-clipper.fw-right .fw-circle {
            left: -100%;
            border-left-color: transparent !important;
            transform: rotate(-129deg);
        }

        .fw-active .fw-circle-clipper.fw-left .fw-circle {
            /* duration: ARCTIME */
            -webkit-animation: fw-left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-left-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        .fw-active .fw-circle-clipper.fw-right .fw-circle {
            /* duration: ARCTIME */
            -webkit-animation: fw-right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
            animation: fw-right-spin 1333ms cubic-bezier(0.4, 0, 0.2, 1) infinite both;
        }

        @-webkit-keyframes fw-left-spin {
            from {
                transform: rotate(130deg);
            }
            50% {
                transform: rotate(-5deg);
            }
            to {
                transform: rotate(130deg);
            }
        }

        @keyframes fw-left-spin {
            from {
                transform: rotate(130deg);
            }
            50% {
                transform: rotate(-5deg);
            }
            to {
                transform: rotate(130deg);
            }
        }

        @-webkit-keyframes fw-right-spin {
            from {
                transform: rotate(-130deg);
            }
            50% {
                transform: rotate(5deg);
            }
            to {
                transform: rotate(-130deg);
            }
        }

        @keyframes fw-right-spin {
            from {
                transform: rotate(-130deg);
            }
            50% {
                transform: rotate(5deg);
            }
            to {
                transform: rotate(-130deg);
            }
        }

        #spinnerContainer.fw-cooldown {
            /* duration: SHRINK_TIME */
            -webkit-animation: fw-container-rotate 1568ms linear infinite, fw-fade-out 400ms cubic-bezier(0.4, 0, 0.2, 1);
            animation: fw-container-rotate 1568ms linear infinite, fw-fade-out 400ms cubic-bezier(0.4, 0, 0.2, 1);
        }

        @-webkit-keyframes fw-fade-out {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        @keyframes fw-fade-out {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }
    </style>
    <?php
}
