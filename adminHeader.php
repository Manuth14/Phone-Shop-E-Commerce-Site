<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="bootstarp/css/bootstrap.css" />
</head>

<body>

    <!-- Header/lg -->
    <div style="border-bottom: solid rgb(169, 169, 169, 0.5) 3px;" class="col-12 d-none d-lg-block bg-white">
        <div class="row">

            <div class="col-1 my-2">
                <img src="resources/logo.png" class="w-100 offset-1" />
            </div>

            <div class="col-4">
                <h1 class="text-secondary fw-bold text-center">Good Morning,</h1>
                <h4 class="text-secondary text-center">Your performance summary</h4>
            </div>

            <div class="col-3">
                <div style="border: solid 2px;" class="input-group border-danger mt-4">
                    <input type="text" class="form-control" style="border:none; box-shadow:none; font-size:17px" placeholder="Search Here..." aria-label="Text input with dropdown button" />
                    <button class="border-0 bg-danger" style="width: 35px;"><i class="bi bi-search text-white" style="font-size: 18px;"></i></button>
                </div>
            </div>

            <div class="col-1">
                <div class="row">

                    <div class="col-4 offset-2 mt-4 text-end">

                        <button class="position-relative bg-white border-0">
                            <i class="bi bi-envelope fs-2"></i>
                            <span style="margin-left: 30px; margin-top: 6px" class="position-absolute top-0 start-0 p-1 bg-danger rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </button>

                    </div>

                    <div class="col-4 offset-2 mt-4 text-end">

                        <button class="position-relative bg-white border-0">
                            <i class="bi bi-bell fs-2"></i>
                            <span style="margin-left: 24px; margin-top: 4px" class="position-absolute top-0 start-0 p-1 bg-danger rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </button>

                    </div>

                </div>
            </div>

            <div class="col-3 dropdown" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="My Profile">
                <div class="row">

                    <ul class="dropdown-menu col-6">
                        <li style="cursor: pointer; height: 35px; border-bottom: solid 2px rgb(195, 195, 195, 0.5);" class="dropdown-item" href="#"><i class="bi bi-person"></i>&nbsp; My Profile</li>
                        <li style="cursor: pointer; height: 35px; border-bottom: solid 2px rgb(195, 195, 195, 0.5);" class="dropdown-item" href="#"><i class="bi bi-envelope"></i>&nbsp; Inbox</li>
                        <li style="cursor: pointer; height: 35px; border-bottom: solid 2px rgb(195, 195, 195, 0.5);" class="dropdown-item" href="#"><i class="bi bi-gear"></i>&nbsp; Settings</li>
                        <li style="cursor: pointer; height: 35px; border-bottom: solid 2px rgb(195, 195, 195, 0.5);" class="dropdown-item" href="#"><i class="bi bi-question-circle"></i>&nbsp; FAQ</li>
                        <li style="cursor: pointer; height: 35px;" class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i>&nbsp; Sign Out</li>
                    </ul>

                    <div class="col-3 offset-1">
                        <img style="border-radius: 50%;" src="resources/user.png" width="70" height="70" class="bg-primary my-1" />
                    </div>

                    <div style="cursor: pointer;" class="col-8" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="col-12 mt-2">
                            <h3 class="text-center fw-bold text-danger">Manuth Thejaka</h3>
                        </div>

                        <div class="col-12">
                            <h6 class="text-secondary text-center fw-bold">Founder</h6>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Header/sm -->
    <div style="border-bottom: solid rgb(169, 169, 169, 0.5) 3px;" class="col-12 d-block d-lg-none bg-white">
        <div class="row">

            <div class="col-12">
                <h1 class="text-secondary fw-bold text-center">Good Morning,</h1>
                <h4 class="text-secondary text-center">Your performance summary</h4>
            </div>

            <hr class="my-2" />

            <div class="col-12">
                <div class="row">

                    <div class="col-2">
                        <div class="search-box">
                            <button class="btn-search"><i class="bi bi-search fs-2"></i></button>
                            <input type="text" class="input-search" placeholder="Type to Search...">
                        </div>
                    </div>

                    <div class="col-8 text-center">
                        <h2 style="font-size: 35px; letter-spacing: 2px;" class="fw-bold">Dashboard</h2>
                    </div>

                    <div class="col-2">
                        <i style="font-size: 30px;" class="bi bi-list text-secondary" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></i>

                        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <div class="col-5 offset-3 mt-2 offcanvas-title" id="offcanvasExampleLabel">
                                    <img src="resources/logo.png" class="w-100 offset-1" />
                                </div>

                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>

                            <hr />

                            <div class="offcanvas-body">
                                <div class="col-12 dropdown" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="My Profile">
                                    <div class="row">

                                        <ul class="dropdown-menu col-6">
                                            <li style="cursor: pointer; height: 35px; border-bottom: solid 2px rgb(195, 195, 195, 0.5);" class="dropdown-item" href="#"><i class="bi bi-person"></i>&nbsp; My Profile</li>
                                            <li style="cursor: pointer; height: 35px; border-bottom: solid 2px rgb(195, 195, 195, 0.5);" class="dropdown-item" href="#"><i class="bi bi-envelope"></i>&nbsp; Inbox</li>
                                            <li style="cursor: pointer; height: 35px; border-bottom: solid 2px rgb(195, 195, 195, 0.5);" class="dropdown-item" href="#"><i class="bi bi-gear"></i>&nbsp; Settings</li>
                                            <li style="cursor: pointer; height: 35px; border-bottom: solid 2px rgb(195, 195, 195, 0.5);" class="dropdown-item" href="#"><i class="bi bi-question-circle"></i>&nbsp; FAQ</li>
                                            <li style="cursor: pointer; height: 35px;" class="dropdown-item" href="#"><i class="bi bi-box-arrow-right"></i>&nbsp; Sign Out</li>
                                        </ul>

                                        <div class="col-3 offset-1">
                                            <img style="border-radius: 50%;" src="resources/add-user (1).png" width="80" height="80" class="bg-primary my-1" />
                                        </div>

                                        <div style="cursor: pointer;" class="col-8 mt-3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <div class="col-12 mt-2">
                                                <h2 class="text-center fw-bold text-danger">Manuth Thejaka</h2>
                                            </div>

                                            <div class="col-12">
                                                <h5 class="text-secondary text-center fw-bold">Founder</h5>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="col-12 mt-5">

                                    <div class="vstack mt-5 gap-3">
                                        <div style="border: solid; height: 50px; border-radius: 25px; border: none; font-size: 25px; cursor: pointer; background-color: orange; background-image: linear-gradient(90deg,#ff4000 0%,#efda20 100%); color: white; font-weight: bold;" class="p-2">&nbsp; <i style="font-size: 25px;" class="bi bi-bar-chart"></i>&nbsp; Dashboard</div>
                                        <div style="border: solid; height: 50px; border-radius: 25px; border: none; font-size: 25px; cursor: pointer;" class="p-2 side-btn">&nbsp; <i style="font-size: 25px;" class="bi bi-receipt"></i>&nbsp; Orders &nbsp; <i class="bi bi-arrow-right"></i></div>
                                        <div style="border: solid; height: 50px; border-radius: 25px; border: none; font-size: 25px; cursor: pointer;" class="p-2 side-btn">&nbsp; <i style="font-size: 25px;" class="bi bi-truck"></i>&nbsp; Products &nbsp; <i class="bi bi-arrow-right"></i></div>
                                        <div style="border: solid; height: 50px; border-radius: 25px; border: none; font-size: 25px; cursor: pointer;" class="p-2 side-btn">&nbsp; <i style="font-size: 25px;" class="bi bi-person-badge"></i>&nbsp; Buyers &nbsp; <i class="bi bi-arrow-right"></i></div>
                                        <div style="border: solid; height: 50px; border-radius: 25px; border: none; font-size: 25px; cursor: pointer;" class="p-2 side-btn">&nbsp; <i style="font-size: 25px;" class="bi bi-receipt"></i>&nbsp; Invoices &nbsp; <i class="bi bi-arrow-right"></i></div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>