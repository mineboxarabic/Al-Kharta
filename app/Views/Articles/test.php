<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>



        <div id="container">

            <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Choices</h4>
                                <p class="card-title-desc">Choices.js is a lightweight, configurable select box/text input plugin.</p>
                            </div>
                            <!-- end card header -->

                            <div class="card-body">
                                <div>
                                    <h5 class="font-size-14 mb-3">Single select input Example</h5>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-single-default" class="form-label font-size-13 text-muted">Default</label>
                                                <select class="form-control" data-trigger name="choices-single-default" id="choices-single-default" placeholder="This is a search placeholder">
                                                    <option value="">This is a placeholder</option>
                                                    <option value="Choice 1">Choice 1</option>
                                                    <option value="Choice 2">Choice 2</option>
                                                    <option value="Choice 3">Choice 3</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-single-groups" class="form-label font-size-13 text-muted">Option
                                                    groups</label>
                                                <select class="form-control" data-trigger name="choices-single-groups" id="choices-single-groups">
                                                    <option value="">Choose a city</option>
                                                    <optgroup label="UK">
                                                        <option value="London">London</option>
                                                        <option value="Manchester">Manchester</option>
                                                        <option value="Liverpool">Liverpool</option>
                                                    </optgroup>
                                                    <optgroup label="FR">
                                                        <option value="Paris">Paris</option>
                                                        <option value="Lyon">Lyon</option>
                                                        <option value="Marseille">Marseille</option>
                                                    </optgroup>
                                                    <optgroup label="DE" disabled>
                                                        <option value="Hamburg">Hamburg</option>
                                                        <option value="Munich">Munich</option>
                                                        <option value="Berlin">Berlin</option>
                                                    </optgroup>
                                                    <optgroup label="US">
                                                        <option value="New York">New York</option>
                                                        <option value="Washington" disabled>Washington</option>
                                                        <option value="Michigan">Michigan</option>
                                                    </optgroup>
                                                    <optgroup label="SP">
                                                        <option value="Madrid">Madrid</option>
                                                        <option value="Barcelona">Barcelona</option>
                                                        <option value="Malaga">Malaga</option>
                                                    </optgroup>
                                                    <optgroup label="CA">
                                                        <option value="Montreal">Montreal</option>
                                                        <option value="Toronto">Toronto</option>
                                                        <option value="Vancouver">Vancouver</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-single-no-search" class="form-label font-size-13 text-muted">Options added
                                                    via config with no search</label>
                                                <select class="form-control" name="choices-single-no-search" id="choices-single-no-search">
                                                    <option value="0">Zero</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-single-no-sorting" class="form-label font-size-13 text-muted">Options added
                                                    via config with no search</label>
                                                <select class="form-control" name="choices-single-no-sorting" id="choices-single-no-sorting">
                                                    <option value="Madrid">Madrid</option>
                                                    <option value="Toronto">Toronto</option>
                                                    <option value="Vancouver">Vancouver</option>
                                                    <option value="London">London</option>
                                                    <option value="Manchester">Manchester</option>
                                                    <option value="Liverpool">Liverpool</option>
                                                    <option value="Paris">Paris</option>
                                                    <option value="Malaga">Malaga</option>
                                                    <option value="Washington" disabled>Washington</option>
                                                    <option value="Lyon">Lyon</option>
                                                    <option value="Marseille">Marseille</option>
                                                    <option value="Hamburg">Hamburg</option>
                                                    <option value="Munich">Munich</option>
                                                    <option value="Barcelona">Barcelona</option>
                                                    <option value="Berlin">Berlin</option>
                                                    <option value="Montreal">Montreal</option>
                                                    <option value="New York">New York</option>
                                                    <option value="Michigan">Michigan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- Single select input Example -->


                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-3">Multiple select input</h5>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-multiple-default" class="form-label font-size-13 text-muted">Default</label>
                                                <select class="form-control" data-trigger name="choices-multiple-default" id="choices-multiple-default" placeholder="This is a placeholder" multiple>
                                                    <option value="Choice 1" selected>Choice 1</option>
                                                    <option value="Choice 2">Choice 2</option>
                                                    <option value="Choice 3">Choice 3</option>
                                                    <option value="Choice 4" disabled>Choice 4</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-multiple-remove-button" class="form-label font-size-13 text-muted">With
                                                    remove button</label>
                                                <select class="form-control" name="choices-multiple-remove-button" id="choices-multiple-remove-button" placeholder="This is a placeholder" multiple>
                                                    <option value="Choice 1" selected>Choice 1</option>
                                                    <option value="Choice 2">Choice 2</option>
                                                    <option value="Choice 3">Choice 3</option>
                                                    <option value="Choice 4">Choice 4</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-multiple-groups" class="form-label font-size-13 text-muted">Option
                                                    groups</label>
                                                <select class="form-control" name="choices-multiple-groups" id="choices-multiple-groups" placeholder="This is a placeholder" multiple>
                                                    <option value="">Choose a city</option>
                                                    <optgroup label="UK">
                                                        <option value="London">London</option>
                                                        <option value="Manchester">Manchester</option>
                                                        <option value="Liverpool">Liverpool</option>
                                                    </optgroup>
                                                    <optgroup label="FR">
                                                        <option value="Paris">Paris</option>
                                                        <option value="Lyon">Lyon</option>
                                                        <option value="Marseille">Marseille</option>
                                                    </optgroup>
                                                    <optgroup label="DE" disabled>
                                                        <option value="Hamburg">Hamburg</option>
                                                        <option value="Munich">Munich</option>
                                                        <option value="Berlin">Berlin</option>
                                                    </optgroup>
                                                    <optgroup label="US">
                                                        <option value="New York">New York</option>
                                                        <option value="Washington" disabled>Washington</option>
                                                        <option value="Michigan">Michigan</option>
                                                    </optgroup>
                                                    <optgroup label="SP">
                                                        <option value="Madrid">Madrid</option>
                                                        <option value="Barcelona">Barcelona</option>
                                                        <option value="Malaga">Malaga</option>
                                                    </optgroup>
                                                    <optgroup label="CA">
                                                        <option value="Montreal">Montreal</option>
                                                        <option value="Toronto">Toronto</option>
                                                        <option value="Vancouver">Vancouver</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end row -->
                                </div>
                                <!-- multi select input Example -->

                                <div class="mt-4">
                                    <h5 class="font-size-14 mb-3">Text inputs</h5>

                                    <div class="row">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-text-remove-button" class="form-label font-size-13 text-muted">Limited to 5
                                                    values with remove button</label>
                                                <input class="form-control" id="choices-text-remove-button" type="text" value="Task-1,Task-2" placeholder="Enter something" />
                                            </div>
                                        </div>
                                        <!-- end col -->

                                        <div class="col-lg-4 col-md-6">
                                            <div class="mb-3">
                                                <label for="choices-text-unique-values" class="form-label font-size-13 text-muted">Unique values
                                                    only, no pasting</label>
                                                <input class="form-control" id="choices-text-unique-values" type="text" value="Project-A, Project-B" placeholder="This is a placeholder" class="custom class" />
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div>
                                        <label for="choices-text-disabled" class="form-label font-size-13 text-muted">Disabled</label>
                                        <input class="form-control" id="choices-text-disabled" type="text" value="josh@joshuajohnson.co.uk, joe@bloggs.co.uk" placeholder="This is a placeholder" />
                                    </div>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>

       
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<!-- JAVASCRIPT -->
<script src="<?= base_url() ?>assets/libs/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>assets/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>assets/libs/node-waves/waves.min.js"></script>
<script src="<?= base_url() ?>assets/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="<?= base_url() ?>assets/libs/pace-js/pace.min.js"></script>
<!-- choices js -->
<script src="<?= base_url() ?>assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>

<!-- color picker js -->
<script src="<?= base_url() ?>assets/libs/@simonwep/pickr/pickr.min.js"></script>
<script src="<?= base_url() ?>assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>

<!-- datepicker js -->
<script src="<?= base_url() ?>assets/libs/flatpickr/flatpickr.min.js"></script>



<script src="<?= base_url() ?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?= base_url() ?>assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js">
    </script>

    
<!-- init js -->
<script src="<?= base_url() ?>assets/js/pages/form-advanced.init.js"></script>

<script src="<?= base_url() ?>assets/js/app.js"></script>


<?= $this->endSection() ?>