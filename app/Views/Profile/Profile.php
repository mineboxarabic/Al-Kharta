<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<script type="module" src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
<?php use App\Classes\Card_Article; ?>

<style>
.grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 10px;

}

.grid img {
    width: 100%;
    height: 300px;

    object-fit: cover;
}

tbody{
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
}


</style>

<!-- start page title -->
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Profile</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<!-- end page title -->

<div class="row">
    <div class="col-xl-9 col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm order-2 order-sm-1">
                        <div class="d-flex align-items-start mt-3 mt-sm-0">
                            <div class="flex-shrink-0">
                                <div class="avatar-xl me-3">
                                    <img src="<?php 
                                    //bring the image from the database
                                    $image = session()->get('avatar');
                                    if(strpos($image, 'http') !== false){
                                        echo $image;
                                    }else{
                                        echo base_url() . 'Profiles/Images/' . $image;
                                    }
                                
                                ?>" alt="" class="img-fluid rounded-circle d-block">
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div>
                                    <h5 class="font-size-16 mb-1"><?= $user['username'] ?>
                                    </h5>
                                    <p class="text-muted font-size-13"><?php 
                                            if($user['role'] == 0){
                                                echo 'user';
                                            }
                                            else if($user['role'] == 1){
                                                echo 'Administrator';
                                            }
                                            else if($user['role'] == 2){
                                                echo 'Writer';
                                            }
                                            else{
                                                echo 'Moderator';
                                            }
                                        ?></p>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-auto order-1 order-sm-2">
                        <div class="d-flex align-items-start justify-content-end gap-2">

                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link font-size-16 shadow-none text-muted dropdown-toggle"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bx bx-dots-horizontal-rounded"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="profile/M">Edit profile</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs-custom card-header-tabs border-top mt-4" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link px-3 active" data-bs-toggle="tab" href="#overview" role="tab">Overview</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" data-bs-toggle="tab" href="#about" role="tab">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3" data-bs-toggle="tab" href="#post" role="tab">Post</a>
                    </li>
                </ul>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="tab-content">
            <div class="tab-pane active" id="overview" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Overview</h5>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="pb-3">
                                <div class="row">
                                    <div class="col-xl-2">
                                        <div>
                                            <h5 class="font-size-15">Bio :</h5>
                                        </div>
                                    </div>
                                    <div class="col-xl">
                                        <div class="text-muted">
                                            <p class="mb-2"><?= $profile['Bio'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="py-3">

                            </div>
                        </div>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Articles</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="#post">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="grid">
                            <?php foreach($articles as $article){
                                $user = new UsersModel();
                                $writer = $user->find($article['writer']);
                                $article['username'] = $writer['username'];
                                $card = new Card_Article($article);
                            // echo '<script>console.log("'.$card->getCard().'")</script>';
                                echo '<div class="grid-item">';
                                echo $card->getCard();
                                echo '</div>';
                                
                            }

                                        
                            ?>


                            <!-- end col -->
                        </div>

                    </div>
                </div>

                <!-- end row -->
            </div>

            <!-- end card body -->
        
        <!-- end card -->

        <!-- end tab pane -->

        <div class="tab-pane" id="about" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">About</h5>
                </div>
                <div class="card-body">
                    <div>
                        <div class="pb-3">
                            <h5 class="font-size-15">Bio :</h5>
                            <div class="text-muted">
                                <p class="mb-2">Hi I'm Phyllis Gatlin, Lorem Ipsum is simply dummy text of the
                                    printing and typesetting industry. Lorem Ipsum has been the industry's
                                    standard dummy text ever since the 1500s, when an unknown printer took a
                                    galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic
                                    typesetting, remaining essentially unchanged. It was popularised in the
                                    1960s with the release of Letraset sheets containing Lorem Ipsum passages
                                </p>
                                <p class="mb-2">It is a long established fact that a reader will be distracted
                                    by the readable content of a page when looking at it has a more-or-less
                                    normal distribution of letters</p>
                                <p>It will be as simple as Occidental; in fact, it will be Occidental. To an
                                    English person, it will seem like simplified English, as a skeptical
                                    Cambridge friend of mine told me what Occidental is. The European languages
                                    are members of the same family. Their separate existence is a myth.</p>

                                <ul class="list-unstyled mb-0">
                                    <li class="py-1"><i
                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Donec
                                        vitae sapien ut libero venenatis faucibus</li>
                                    <li class="py-1"><i
                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Quisque
                                        rutrum aenean imperdiet</li>
                                    <li class="py-1"><i
                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Integer
                                        ante a consectetuer eget</li>
                                </ul>
                            </div>
                        </div>

                        <div class="pt-3">
                            <h5 class="font-size-15">Experience :</h5>
                            <div class="text-muted">
                                <p>If several languages coalesce, the grammar of the resulting language is more
                                    simple and regular than that of the individual languages. The new common
                                    language will be more simple and regular than the existing European
                                    languages. It will be as simple as Occidental; in fact, it will be
                                    Occidental. To an English person, it will seem like simplified English, as a
                                    skeptical Cambridge friend of mine told me what Occidental is. The European
                                    languages are members of the same family. Their separate existence is a
                                    myth. For science, music, sport, etc</p>

                                <ul class="list-unstyled mb-0">
                                    <li class="py-1"><i
                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Donec
                                        vitae sapien ut libero venenatis faucibus</li>
                                    <li class="py-1"><i
                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Quisque
                                        rutrum aenean imperdiet</li>
                                    <li class="py-1"><i
                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Integer
                                        ante a consectetuer eget</li>
                                    <li class="py-1"><i
                                            class="mdi mdi-circle-medium me-1 text-success align-middle"></i>Phasellus
                                        nec sem in justo pellentesque</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end tab pane -->

        <div class="tab-pane" id="post" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Post</h5>
                </div>
                <div class="card-body">
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-xl-8">


                                <h1 class="mt-0 mb-1">Articles Go here</h1>

                            </div>
                            <!-- end col -->

                        </div>
                        <!-- end row -->

                        <div class="row g-0 mt-4">
                            <div class="col-sm-6">
                                <div>
                                    <p class="mb-sm-0">Showing 1 to 10 of 57 entries</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="float-sm-end">
                                    <ul class="pagination mb-sm-0">
                                        <li class="page-item disabled">
                                            <a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">1</a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="#" class="page-link">2</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">4</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link">5</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        </div>
    </div>

    <!-- end tab pane -->

    <!-- end tab content -->



    <!-- end col -->

    <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Skills</h5>

                <div class="d-flex flex-wrap gap-2 font-size-16">
                    <!--<a href="#" class="badge badge-soft-primary">Photoshop</a>
                    <a href="#" class="badge badge-soft-primary">illustrator</a>
                    <a href="#" class="badge badge-soft-primary">HTML</a>
                    <a href="#" class="badge badge-soft-primary">CSS</a>
                    <a href="#" class="badge badge-soft-primary">Javascript</a>
                    <a href="#" class="badge badge-soft-primary">Php</a>
                    <a href="#" class="badge badge-soft-primary">Python</a> -->
                    <?php 
                        foreach($profile['Tags'] as $Tag){
                            echo '<a href="#" class="badge badge-soft-primary">'.$Tag.'</a>';
                        }
                    ?>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">Links</h5>

                <div>
                    <ul class="list-unstyled mb-0">
                        <!--<li>
                            <a href="#" class="py-2 d-block text-muted"><i class="mdi mdi-web text-primary me-1"></i>
                                Website</a>
                        </li>
                        <li>
                            <a href="#" class="py-2 d-block text-muted"><i
                                    class="mdi mdi-note-text-outline text-primary me-1"></i> Blog</a>
                        </li>-->
                        <?php 
                            foreach($profile['links'] as $link){
                                echo '<a href="'.$link['Link'].'" class="py-2 d-block text-muted">'. $link['Logo'].$link['Name'].'</a>';
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>

</div>


<?= $this->endSection() ?>