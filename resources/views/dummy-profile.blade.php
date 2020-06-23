<html>
<link rel="stylesheet" type="text/css" href="/stylesheets/template_normal.min.css?0.82">
<title>BPJSTK KPJ Checking</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<meta name="apple-mobile-web-app-capable" content="yes">
</head>

<body id="dvcard-body" ng-controller="ComplexController" class="whiteTheme ng-scope" style="">

    <div class="loading-welcome active welcome-screen"
        ng-style="{'background-color': view.code.welcome_extra.background || view.welcome_extra.background}"
        style="background-color: rgb(255, 255, 255); display: none;">
        <div class="progress">
            <div class="loading-bar indeterminate" ng-style="{'background-color': view.code.color1 || view.color1}"
                style="background-color: rgb(76, 175, 80);"></div>
        </div>
        <div class="helper"></div>
    </div>
    <div class="vcard-template style2" id="rootElement">
        <div class="bgd-shadow"></div>
        <div class="page-home page">
            <div class="vcard-header gradient-red-orange-bg" ng-style="getBackgroundColor();"
                style="background: linear-gradient(45deg, rgb(76, 175, 80) 0%, rgb(76, 175, 80) 1%, rgb(100, 198, 136) 100%);">
                <div class="vcard-header-wrapper">
                    <div class="vcard-top-info">
                        <h4 class="top"></h4>

                        <div class="img" style="background: url('/foto/5103051104910006');"></div>
                        <h2 class="name dynamicTextColor ng-binding">PUTU ALAN ARISMANDIKA</h2>

                    </div>
                    <div class="vcard-functions">
                        <div class="vcard-functions-wrapper">


                            <a href="tel:6281212341417">
                                <i class="icon-phone dynamicTextColor"></i>
                                <small class="dynamicTextColor">Call</small>
                            </a>

                            <a href="mailto:arismandika@gmail.com" target="_newEmail" class="last-element">
                                <i class="icon-send dynamicTextColor"></i>
                                <small class="dynamicTextColor">Email</small>
                            </a>



                        </div>
                    </div>
                </div>
            </div>
            <div class="vcard-body-wrapper">
                <div class="vcard-body">
                    <div id="dvcard-details">
                        <div class="vcard-row" ng-show="view.numbers_mobile">
                            <i class="icon icon-birthday"></i>
                            <h4 class="ng-binding">11/04/1991</h4>
                            <small>Tanggal Lahir</small>
                        </div>
                        <div class="vcard-row" ng-show="view.numbers_mobile">
                            <i class="icon icon-add-user"></i>


                            <h4><a href="#" class="ng-binding">5103 0511 0491 0006</a></h4>
                            <small>NIK</small>
                        </div>
                        <div class="vcard-separator"></div>
                        <div class="vcard-row" ng-show="view.numbers_mobile">
                            <i class="icon icon-work"></i>
                            <h4><a href="#" class="ng-binding">JHT, JKK, JKM</a></h4>
                            <small>Program</small>
                        </div>
                        <div class="vcard-separator"></div>
                        <div class="vcard-row" ng-show="view.numbers_mobile">
                            <i class="icon icon-phone"></i>
                            <h4><a href="tel:081281925228" class="ng-binding">6281212341417</a></h4>
                            <small>No. Handphone</small>
                        </div>
                        <div class="vcard-separator" ng-show="view.numbers_mobile || view.numbers_phone"></div>
                        <div class="vcard-row" ng-show="view.email">
                            <i class="icon icon-mail"></i>
                            <h4><a href="mailto:arismandika@gmail.com" target="_newLink"
                                    class="ng-binding">arismandika@gmail.com</a></h4>
                            <small>Email</small>
                        </div>
                        <div class="vcard-separator ng-hide"
                            ng-show="view.street || view.zip || view.city || view.country || view.company "></div>
                        <div class="vcard-separator" ng-show="view.email"></div>
                        <div class="vcard-row" ng-show="view.email">
                            <label></label>
                            <i class="icon icon-event-location"></i>
                            <h4 class="ng-binding">JL. POH GADING/9, LINGK. JERO KUTA</h4>
                            <h4 class="ng-binding"></h4>

                        </div>

                    </div>

                </div>
            </div>
        </div>


        <!--    -->
    </div>
</body>

</html>
