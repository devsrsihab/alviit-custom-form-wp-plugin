  <?php 
      $aitcf_nonce = wp_create_nonce("wp_nonce_aitcf_multistep_form_submit");
  ?>

  <div class="px-2">
      <removal-step>
      <!-- Stepper -->
      <div class="bg-white row py-2 text-center">
        <div id="indicator-wrapper-1" class="col indicator-wrapper pointer pointer">
          <span id="indicator-step-1" class="indicator border border-secondary active text-reset">1</span>
          <span class="d-none d-sm-block"><?= __('Adressen', 'aitcf'); ?></span>
        </div>
        <div id="indicator-wrapper-2" class="col indicator-wrapper pointer">
          <span id="indicator-step-2" class="indicator border border-secondary text-reset">2</span>
          <span class="d-none d-sm-block"><?= __('Voorkeursdatum', 'aitcf'); ?></span>
        </div>
        <div id="indicator-wrapper-3" class="col indicator-wrapper pointer">
          <span id="indicator-step-3" class="indicator border border-secondary text-reset">3</span>
          <span class="d-none d-sm-block"><?= __('Huishoudelijke objecten', 'aitcf'); ?></span>
        </div>
        <div id="indicator-wrapper-4" class="col indicator-wrapper pointer">
          <span id="indicator-step-4" class="indicator border border-secondary text-reset">4</span>
          <span class="d-none d-sm-block"><?= __('Extra opties', 'aitcf'); ?></span>
        </div>
        <div id="indicator-wrapper-5" class="col indicator-wrapper pointer">
          <span id="indicator-step-5" class="indicator border border-secondary text-reset">5</span>
          <span class="d-none d-sm-block"><?= __('Contactgegevens', 'aitcf'); ?></span>
        </div>
        <div id="indicator-wrapper-6" class="col indicator-wrapper pointer">
          <span id="indicator-step-6" class="indicator border border-secondary text-reset">6</span>
          <span class="d-none d-sm-block"><?= __('Prijsindicatie', 'aitcf'); ?></span>
        </div>

        <!-- Progress Bar -->
        <div class="col-12 mt-2">
          <div id="aitcf-progress-bar" class="progress" style="height: 8px;">
            <div class="progress-bar" role="progressbar" style="width: 8.33%;" aria-valuenow="8.33" aria-valuemin="0" aria-valuemax="100" aria-valuetext="8%"></div>
          </div>
        </div>
      </div>




        <div class="container px-0 px-md-3">
          <form
            novalidate=""
            id="aitcf-multiStepForm"
            class="needs-validation ng-untouched ng-pristine ng-invalid ng-submitted"
            action="javascript:void(0}"
          >

          <input id="wp_nonce_alviitcf_msf" type="hidden" name="wp_nonce_aitcf_multistep_form_submit" value="<?php echo $aitcf_nonce; ?>">

            <!-- language picker -->
            <div class="alviit-cf-language">
                <?php
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Ensure plugin functions are available

                if ( is_plugin_active( 'gtranslate/gtranslate.php' ) && function_exists( 'do_shortcode' ) ) {
                    echo do_shortcode('[gtranslate]');
                }
                ?>
            </div>
            <!-- language end -->

          <!-- step 1 start -->
          <div id="step-1" class="step active col-12 mb-2">


            <form-addresses>
              <div class="row ng-untouched ng-pristine ng-invalid">
                
              <!-- address A -->
               <div class="col-md-6 px-0 px-sm-3 ng-untouched ng-pristine ng-invalid">
   
                  <div class="card  card-body px-0 px-sm-3 mb-3">
                      <h4 class="card-title d-flex justify-content-between">
                        <?php echo __( 'Beginadres A', 'aitcf' ); ?>
                      </h4>
                    <form-address id="addressA" class="ng-untouched ng-pristine ng-invalid">
                      <fieldset>
                        <!-- country -->
                        <form-floating>
                          <div class="form-group mb-3">
                            <div class="input-group">
                              <div class="form-floating flex-grow-1">
                                <select id="country" name="country" data-cy="country" input-validation="" class="form-select ng-untouched ng-pristine ng-valid">
                                  <option value="Netherlands"><?php echo __( 'Nederland', 'aitcf' ); ?></option>
                                  <option value="Belgium"><?php echo __( 'België', 'aitcf' ); ?></option>
                                  <option value="Luxembourg"><?php echo __( 'Luxemburg', 'aitcf' ); ?></option>
                                  <option value="Germany"><?php echo __( 'Duitsland', 'aitcf' ); ?></option>
                                  <option value="Denmark"><?php echo __( 'Denemarken', 'aitcf' ); ?></option>
                                  <option value="France"><?php echo __( 'Frankrijk', 'aitcf' ); ?></option>
                                  <option value="Spain"><?php echo __( 'Spanje', 'aitcf' ); ?></option>
                                  <option value="Italy"><?php echo __( 'Italië', 'aitcf' ); ?></option>
                                  <option value="Sweden"><?php echo __( 'Zweden', 'aitcf' ); ?></option>
                                  <option value="Portugal"><?php echo __( 'Portugal', 'aitcf' ); ?></option>
                                </select>
                                <label app-i18n="addressDetails_country_label"><?php echo __( 'Land', 'aitcf' ); ?></label>
                              </div>
                            </div>
                          </div>
                        </form-floating>

                        <!-- postal, house number, addition -->
                        <div class="row">
                          <!-- postal -->
                          <div class="col-12 col-sm-6">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="postal" name="postal" type="text" placeholder="<?php echo esc_attr__( 'Postcode', 'aitcf' ); ?>" data-cy="postal" input-validation="" class="form-control ng-untouched ng-pristine ng-invalid" required="true" />
                                    <label><?php echo __( 'Postcode', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>

                          <!-- house number -->
                          <div class="col-12 col-sm-3">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="houseNumber" name="houseNumber" type="text" placeholder="<?php echo esc_attr__( 'Huisnummer', 'aitcf' ); ?>" data-cy="number" input-validation="" class="form-control ng-untouched ng-pristine ng-invalid" required="true" />
                                    <label app-i18n="addressDetails_streetNumber_label"><?php echo __( 'Huisnummer', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>

                          <!-- addition -->
                          <div class="col-12 col-sm-3">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="addition" name="addition" type="text" placeholder="<?php echo esc_attr__( 'Toevoeging', 'aitcf' ); ?>" data-cy="addition" input-validation="" class="form-control ng-untouched ng-pristine ng-valid" />
                                    <label i18="@@addressDetails_streetAddition_place" app-i18n="addressDetails_streetAddition_place"><?php echo __( 'Toevoeging', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>
                        </div>
                        <!-- /postal, house number, addition -->

                        <!-- City and street -->
                        <div class="row">
                          <div class="col-12 col-sm-6">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="city" name="city" type="text" placeholder="<?php echo esc_attr__( 'Stad', 'aitcf' ); ?>" class="form-control ng-untouched ng-pristine" required="true" />
                                    <label app-i18n="addressDetails_city_label"><?php echo __( 'Stad', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>
                          <div class="col-12 col-sm-6">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="street" name="street" type="text" placeholder="<?php echo esc_attr__( 'Straat', 'aitcf' ); ?>" class="form-control ng-untouched ng-pristine" required="true" />
                                    <label app-i18n="addressDetails_streetName_label"><?php echo __( 'Straat', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>
                        </div>
                        <!-- /City and street -->

                        <!-- Floor number -->
                        <h5 app-i18n="addressDetails_label_info" class="card-title mt-2"><?php echo __( 'Verhuisinformatie', 'aitcf' ); ?></h5>
                        <form-floating>
                          <div class="form-group mb-3">
                            <div class="input-group">
                              <div class="form-floating flex-grow-1">
                                <select id="floorNumber" name="floorNumber" input-validation="" class="floorNumber form-select ng-untouched ng-pristine ng-valid">
                                  <option selected="" disabled="" app-i18n="addressDetails_floor_select" value="0: null"><?php echo __( 'Kies een verdieping', 'aitcf' ); ?></option>
                                  <option value="Ground floor"><?php echo __( 'Begane grond', 'aitcf' ); ?></option>
                                  <option value="Short flight of entrance stairs"><?php echo __( 'Korte trap bij ingang', 'aitcf' ); ?></option>
                                  <option value="1st floor"><?php echo __( '1e verdieping', 'aitcf' ); ?></option>
                                  <option value="2nd floor"><?php echo __( '2e verdieping', 'aitcf' ); ?></option>
                                  <option value="3rd floor"><?php echo __( '3e verdieping', 'aitcf' ); ?></option>
                                  <option value="4th floor"><?php echo __( '4e verdieping', 'aitcf' ); ?></option>
                                  <option value="5th floor"><?php echo __( '5e verdieping', 'aitcf' ); ?></option>
                                  <option value="6th floor"><?php echo __( '6e verdieping', 'aitcf' ); ?></option>
                                  <option value="7th floor"><?php echo __( '7e verdieping', 'aitcf' ); ?></option>
                                  <option value="8th floor"><?php echo __( '8e verdieping', 'aitcf' ); ?></option>
                                  <option value="9th floor"><?php echo __( '9e verdieping', 'aitcf' ); ?></option>
                                  <option value="10+ floor"><?php echo __( '10+ verdieping', 'aitcf' ); ?></option>
                                </select>
                                <label app-i18n="addressDetails_floor_label"><?php echo __( 'Verdieping', 'aitcf' ); ?></label>
                              </div>
                            </div>
                          </div>
                          <div id="isLiftWrapper" class="isLiftWrapper mb-3 ng-star-inserted d-none">
                            <div class="form-check form-switch">
                              <input name="isLiftAvailable" type="checkbox" id="isLiftAvailable" class="form-check-input ng-touched ng-dirty ng-valid" />
                              <div class="input-group input-group-sm d-flex align-items-center">
                                <label for="isLiftAvailable" data-cy="isLiftAvailable" app-i18n="addressDetails_moveMethod_question_liftInternal" class="form-check-label text-muted"><?php echo __( 'Is er een interne lift?', 'aitcf' ); ?></label>
                              </div>
                            </div>
                          </div>
                        </form-floating>
                        <!-- /Floor number -->

                        <!-- Description -->
                        <form-floating>
                          <div class="form-group mb-3">
                            <div class="input-group">
                              <div class="form-floating flex-grow-1">
                                <textarea id="jobDescription" name="jobDescription" placeholder="<?php echo esc_attr__( 'U kunt hier extra informatie geven over wat er op dit adres moet gebeuren.', 'aitcf' ); ?>" input-validation="" autocomplete="off" class="form-control ng-untouched ng-pristine ng-valid" style="height: 200px"></textarea>
                                <label app-i18n="addressDetails_workDescription_label"><?php echo __( 'Taakomschrijving (optioneel)', 'aitcf' ); ?></label>
                              </div>
                            </div>
                            <small class="form-text text-muted">
                              <div help-text="" app-i18n="addressDetails_workDescription_helpText"><?php echo __( 'U kunt hier extra informatie geven over wat er op dit adres moet gebeuren.', 'aitcf' ); ?></div>
                            </small>
                          </div>
                        </form-floating>
                        <!-- /Description -->
                      </fieldset>
                    </form-address>
                  </div>
               </div>

                <!-- address b -->
                <div class="col-md-6 px-0 px-sm-3 ng-untouched ng-pristine ng-invalid">
   
                  <div class="card card-body px-0 px-sm-3 mb-3">
                      <h4 class="card-title d-flex justify-content-between">
                      <?php echo __( 'Eindadres B', 'aitcf' ); ?>
                      </h4>
                    <form-address id="addressB" class="ng-untouched ng-pristine ng-invalid">
                      <fieldset>
                        <!-- country -->
                        <form-floating>
                          <div class="form-group mb-3">
                            <div class="input-group">
                              <div class="form-floating flex-grow-1">
                                <select id="country_a_b" name="country" data-cy="country" input-validation="" class="form-select ng-untouched ng-pristine ng-valid">
                                  <option value="Netherlands"><?php echo __( 'Nederland', 'aitcf' ); ?></option>
                                  <option value="Belgium"><?php echo __( 'België', 'aitcf' ); ?></option>
                                  <option value="Luxembourg"><?php echo __( 'Luxemburg', 'aitcf' ); ?></option>
                                  <option value="Germany"><?php echo __( 'Duitsland', 'aitcf' ); ?></option>
                                  <option value="Denmark"><?php echo __( 'Denemarken', 'aitcf' ); ?></option>
                                  <option value="France"><?php echo __( 'Frankrijk', 'aitcf' ); ?></option>
                                  <option value="Spain"><?php echo __( 'Spanje', 'aitcf' ); ?></option>
                                  <option value="Italy"><?php echo __( 'Italië', 'aitcf' ); ?></option>
                                  <option value="Sweden"><?php echo __( 'Zweden', 'aitcf' ); ?></option>
                                  <option value="Portugal"><?php echo __( 'Portugal', 'aitcf' ); ?></option>
                                </select>
                                <label app-i18n="addressDetails_country_label"><?php echo __( 'Land', 'aitcf' ); ?></label>
                              </div>
                            </div>
                          </div>
                        </form-floating>

                        <!-- postal, house number, addition -->
                        <div class="row">
                          <!-- postal -->
                          <div class="col-12 col-sm-6">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="postal_a_b" name="postal" type="text" placeholder="<?php echo esc_attr__( 'Postcode', 'aitcf' ); ?>" data-cy="postal" input-validation="" class="form-control ng-untouched ng-pristine ng-invalid" required="true" />
                                    <label><?php echo __( 'Postcode', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>

                          <!-- house number -->
                          <div class="col-12 col-sm-3">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="houseNumber_a_b" name="houseNumber" type="text" placeholder="<?php echo esc_attr__( 'Huisnummer', 'aitcf' ); ?>" data-cy="number" input-validation="" class="form-control ng-untouched ng-pristine ng-invalid" required="true" />
                                    <label app-i18n="addressDetails_streetNumber_label"><?php echo __( 'Huisnummer', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>

                          <!-- addition -->
                          <div class="col-12 col-sm-3">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="addition_a_b" name="addition" type="text" placeholder="<?php echo esc_attr__( 'Toevoeging', 'aitcf' ); ?>" data-cy="addition" input-validation="" class="form-control ng-untouched ng-pristine ng-valid" />
                                    <label i18="@@addressDetails_streetAddition_place" app-i18n="addressDetails_streetAddition_place"><?php echo __( 'Toevoeging', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>
                        </div>
                        <!-- /postal, house number, addition -->

                        <!-- City and street -->
                        <div class="row">
                          <div class="col-12 col-sm-6">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="city_a_b" name="city" type="text" placeholder="<?php echo esc_attr__( 'Stad', 'aitcf' ); ?>" class="form-control ng-untouched ng-pristine" required="true" />
                                    <label app-i18n="addressDetails_city_label"><?php echo __( 'Stad', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>
                          <div class="col-12 col-sm-6">
                            <form-floating>
                              <div class="form-group mb-3">
                                <div class="input-group">
                                  <div class="form-floating flex-grow-1">
                                    <input id="street_a_b" name="street" type="text" placeholder="<?php echo esc_attr__( 'Straat', 'aitcf' ); ?>" class="form-control ng-untouched ng-pristine" required="true" />
                                    <label app-i18n="addressDetails_streetName_label"><?php echo __( 'Straat', 'aitcf' ); ?></label>
                                  </div>
                                </div>
                              </div>
                            </form-floating>
                          </div>
                        </div>
                        <!-- /City and street -->

                        <!-- Floor number -->
                        <h5 app-i18n="addressDetails_label_info" class="card-title mt-2"><?php echo __( 'Verhuisinformatie', 'aitcf' ); ?></h5>
                        <form-floating>
                          <div class="form-group mb-3">
                            <div class="input-group">
                              <div class="form-floating flex-grow-1">
                                <select id="floorNumber_a_b" name="floorNumber_a_b" input-validation="" class="floorNumber_a_b form-select ng-untouched ng-pristine ng-valid">
                                  <option selected="" disabled="" app-i18n="addressDetails_floor_select" value="0: null"><?php echo __( 'Kies een verdieping', 'aitcf' ); ?></option>
                                  <option value="Ground floor"><?php echo __( 'Begane grond', 'aitcf' ); ?></option>
                                  <option value="Short flight of entrance stairs"><?php echo __( 'Korte trap bij ingang', 'aitcf' ); ?></option>
                                  <option value="1st floor"><?php echo __( '1e verdieping', 'aitcf' ); ?></option>
                                  <option value="2nd floor"><?php echo __( '2e verdieping', 'aitcf' ); ?></option>
                                  <option value="3rd floor"><?php echo __( '3e verdieping', 'aitcf' ); ?></option>
                                  <option value="4th floor"><?php echo __( '4e verdieping', 'aitcf' ); ?></option>
                                  <option value="5th floor"><?php echo __( '5e verdieping', 'aitcf' ); ?></option>
                                  <option value="6th floor"><?php echo __( '6e verdieping', 'aitcf' ); ?></option>
                                  <option value="7th floor"><?php echo __( '7e verdieping', 'aitcf' ); ?></option>
                                  <option value="8th floor"><?php echo __( '8e verdieping', 'aitcf' ); ?></option>
                                  <option value="9th floor"><?php echo __( '9e verdieping', 'aitcf' ); ?></option>
                                  <option value="10+ floor"><?php echo __( '10+ verdieping', 'aitcf' ); ?></option>
                                </select>
                                <label app-i18n="addressDetails_floor_label"><?php echo __( 'Verdieping', 'aitcf' ); ?></label>
                              </div>
                            </div>
                          </div>
                          <div id="isLiftWrapper_a_b" class="isLiftWrapper_a_b mb-3 ng-star-inserted d-none">
                            <div class="form-check form-switch">
                              <input name="isLiftAvailable" type="checkbox" id="isLiftAvailable_a_b" class="form-check-input ng-touched ng-dirty ng-valid" />
                              <div class="input-group input-group-sm d-flex align-items-center">
                                <label for="isLiftAvailable" data-cy="isLiftAvailable" app-i18n="addressDetails_moveMethod_question_liftInternal" class="form-check-label text-muted"><?php echo __( 'Is er een interne lift?', 'aitcf' ); ?></label>
                              </div>
                            </div>
                          </div>
                        </form-floating>
                        <!-- /Floor number -->

                        <!-- Description -->
                        <form-floating>
                          <div class="form-group mb-3">
                            <div class="input-group">
                              <div class="form-floating flex-grow-1">
                                <textarea id="jobDescription_a_b" name="jobDescription" placeholder="<?php echo esc_attr__( 'U kunt hier extra informatie geven over wat er op dit adres moet gebeuren.', 'aitcf' ); ?>" input-validation="" autocomplete="off" class="form-control ng-untouched ng-pristine ng-valid" style="height: 200px"></textarea>
                                <label app-i18n="addressDetails_workDescription_label"><?php echo __( 'Taakomschrijving (optioneel)', 'aitcf' ); ?></label>
                              </div>
                            </div>
                            <small class="form-text text-muted">
                              <div help-text="" app-i18n="addressDetails_workDescription_helpText"><?php echo __( 'U kunt hier extra informatie geven over wat er op dit adres moet gebeuren.', 'aitcf' ); ?></div>
                            </small>
                          </div>
                        </form-floating>
                        <!-- /Description -->
                      </fieldset>
                    </form-address>
                  </div>
                </div>
              </div>
            </form-addresses>

            <!-- form navigation -->
            <div style="margin: 32px 0" class="row my-10">
              <div class="col-12 d-flex justify-content-between">
                <button style="opacity: 0;" class="aitcf-prevstep-btn" data-cy="previous" type="button" app-i18n="previousButtonText"><?php echo __( 'Terug', 'aitcf' ); ?></button>
                <h5 class="d-none d-sm-block text-center"><?php echo __( 'Hulp nodig bij het invullen van dit formulier?', 'aitcf' ); ?> <br><?php echo __( 'Bel ons op', 'aitcf' ); ?> <a href="tel:09001787">0900 1787</a><br></h5>
                <button type="button" class="aitcf-nextstep-btn btn btn-success btn-lg ms-5 ng-star-inserted">
                  <span app-i18n="submit_buttonText"><?php echo __( 'Volgende', 'aitcf' ); ?></span>
                </button>
              </div>
            </div>
            <!-- /form navigation -->
          </div>
          <!-- step 1 end -->


        <!-- step 2 start -->
        <div class="step" id="step-2">
          <div class="col-12 mb-2">
            <div class="offset-lg-2 col-lg-8">
              <form-date>
                <div class="row">
                  <div class="col-12">
                    <div class="card card-body">
                      <!-- move time start -->
                      <div>
                        <h4
                          app-i18n="moveDetails_moveDate_label_certain"
                          class="card-title"
                        >
                          <?php echo esc_html( __( 'Verhuisdatum en tijd', 'aitcf' ) ); ?>
                        </h4>

                        <form-floating class="mt-2">
                          <div class="form-group mb-3">
                            <div class="input-group">
                              <div class="form-floating flex-grow-1">
                                <select
                                  name="dateFlexibility"
                                  id="dateFlexibility"
                                  required
                                  class="form-control ng-untouched ng-pristine ng-invalid"
                                >
                                  <option
                                    value=""
                                    disabled
                                    app-i18n="moveDetails_startCertainty_choose"
                                  >
                                    <?php echo esc_html( __( 'Kies een optie', 'aitcf' ) ); ?>
                                  </option>
                                  <option
                                    value="certain"
                                    app-i18n="moveDetails_startCertainty_certain"
                                  >
                                    <?php echo esc_html( __( 'Nee', 'aitcf' ) ); ?>
                                  </option>
                                  <option
                                    value="estimate"
                                    app-i18n="moveDetails_startCertainty_estimate"
                                  >
                                    <?php echo esc_html( __( 'Ja', 'aitcf' ) ); ?>
                                  </option>
                                  <option
                                    value="unknown"
                                    app-i18n="moveDetails_startCertainty_unknown"
                                  >
                                    <?php echo esc_html( __( "Ik heb nog geen verhuisdatum", 'aitcf' ) ); ?>
                                  </option>
                                </select>
                                <label
                                  app-i18n="moveDetails_startCertainty_label"
                                >
                                  <?php echo esc_html( __( 'Is uw verhuisdatum flexibel?', 'aitcf' ) ); ?>
                                </label>
                              </div>
                            </div>
                          </div>
                        </form-floating>
                      </div>
                      <!-- move time end -->

                      <!-- period start -->
                      <form-floating
                        id="date-period-wrapper"
                        class="d-none-important ng-star-inserted"
                      >
                        <div class="form-group mb-3">
                          <div class="input-group">
                            <div class="form-floating flex-grow-1">
                              <input
                                type="text"
                                name="date-period"
                                id="date-period"
                                bsdaterangepicker=""
                                input-validation=""
                                class="form-control ng-touched ng-dirty ng-valid is-valid"
                              />
                              <label
                                app-i18n="moveDetails_startCertaintyDates_label"
                              >
                                <?php echo esc_html( __( 'In welke periode?', 'aitcf' ) ); ?>
                              </label>
                            </div>
                          </div>
                          <small class="form-text text-muted"
                            ><span
                              help-text=""
                              app-i18n="moveDetails_startCertaintyDates_helpText"
                              ><?php echo esc_html( __( 'Laat ons weten op welke data u zou kunnen verhuizen, en wij kiezen de meest gunstige dag voor u.', 'aitcf' ) ); ?></span
                            ></small
                          ><small
                            class="form-text text-danger text-right"
                          ></small
                          ><small
                            class="form-text text-muted text-right"
                          ></small>
                        </div>
                      </form-floating>
                      <!-- period end -->

                      <!-- Preferred date start -->
                      <div id="preferred-date">
                        <label
                          app-i18n="moveDetails_date_label"
                          class="ng-star-inserted"
                        >
                          <?php echo esc_html( __( 'Voorkeursdatum', 'aitcf' ) ); ?>
                        </label>
                        <input type="hidden" id="preferred-date-hidden" name="preferred-date-inpute">

                        <div class="calendar-wrapper">
                          <div class="calendar-header">
                            <button id="prevMonth">&#8592;</button>
                            <div id="monthYear"></div>
                            <button id="nextMonth">&#8594;</button>
                          </div>
                          <table class="calendar">
                            <thead>
                              <tr>
                                <th>Zo</th>
                                <th>Ma</th>
                                <th>Di</th>
                                <th>Wo</th>
                                <th>Do</th>
                                <th>Vr</th>
                                <th>Za</th>
                              </tr>
                            </thead>
                            <tbody id="calendar-body"></tbody>
                          </table>
                        </div>
                      </div>
                      <!-- Preferred date end -->

                      <!-- start time -->
                      <div id="start-time" class="mt-3 ng-star-inserted">
                        <form-floating>
                          <div class="form-group mb-3">
                            <div class="input-group">
                              <div class="form-floating flex-grow-1">
                                <select
                                  class="form-select"
                                  name="start-time"
                                  id="start-time-select"
                                  data-gtm-form-interact-field-id="10"
                                >
                                  <option value="09:00">09:00</option>
                                  <option value="09:30">09:30</option>
                                  <option value="10:00">10:00</option>
                                  <option value="10:30">10:30</option>
                                  <option value="11:00">11:00</option>
                                  <option value="11:30">11:30</option>
                                  <option value="12:00">12:00</option>
                                  <option value="12:30">12:30</option>
                                  <option value="13:00">13:00</option>
                                  <option value="13:30">13:30</option>
                                  <option value="14:00">14:00</option>
                                  <option value="14:30">14:30</option>
                                  <option value="15:00">15:00</option>
                                  <option value="15:30">15:30</option>
                                  <option value="16:00">16:00</option>
                                  <option value="16:30">16:30</option>
                                  <option value="17:00" selected>
                                    17:00
                                  </option>
                                  <option value="17:30">17:30</option>
                                  <option value="18:00">18:00</option>
                                  <option value="18:30">18:30</option>
                                  <option value="19:00">19:00</option>
                                  <option value="19:30">19:30</option>
                                </select>
                                <label>
                                  <?php echo esc_html( __( 'Starttijd', 'aitcf' ) ); ?>
                                </label>
                              </div>
                              <span class="input-group-text">
                                <fa-icon class="ng-fa-icon">
                                  <svg
                                    role="img"
                                    aria-hidden="true"
                                    focusable="false"
                                    data-prefix="fal"
                                    data-icon="clock"
                                    class="svg-inline--fa fa-clock fa-fw"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512"
                                  >
                                    <path
                                      fill="currentColor"
                                      d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112V256c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4V112c0-8.8-7.2-16-16-16s-16 7.2-16 16z"
                                    ></path>
                                  </svg>
                                </fa-icon>
                              </span>
                            </div>
                          </div>
                        </form-floating>
                      </div>
                      <!-- time end -->
                    </div>
                  </div>
                </div>
              </form-date>
            </div>
          </div>

          <!--form navigation start-->
          <div style="margin: 32px 0" class="row my-10">
            <div class="col-12 d-flex justify-content-between">
              <button class="aitcf-prevstep-btn" data-cy="previous" type="button" class="btn btn-secondary btn-lg"><?php _e( 'Terug', 'aitcf' ); ?></button>
              <h5 class="d-none d-sm-block text-center"><?php _e( 'Hulp nodig bij het invullen van dit formulier? <br> Bel ons op ', 'aitcf' ); ?><a href="tel:09001787">0900 1787</a><br></h5>
              <button type="button" class="aitcf-nextstep-btn btn btn-success btn-lg ms-5 ng-star-inserted">
                <span><?php _e( 'Volgende', 'aitcf' ); ?></span>
              </button>
            </div>
          </div>
          <!--form navigation end-->
        </div>
        <!-- step 2 end -->


        <!-- step 3 start -->
        <div class="step" id="step-3">
            <div class="row">
                <div id="tabs-wrapper" class="col-12 col-lg-9 px-0 px-md-3">
                    <?php 
                    global $wpdb;
                    $prefix = $wpdb->prefix;
                    $household_rooms = $wpdb->get_results("SELECT * FROM {$prefix}alviit_cf_household_rooms", ARRAY_A);
                    
                    // Define the original tab order
                    $ordered_rooms = [
                        'WOONKAMER' => __('Woonkamer', 'aitcf'),
                        'SLAAPKAMER' => __('Slaapkamer', 'aitcf'),
                        'BADKAMER' => __('Badkamer', 'aitcf'),
                        'WERKKAMER' => __('Werkkamer', 'aitcf'),
                        'KEUKEN' => __('Keuken', 'aitcf'),
                        'SCHUUR' => __('Schuur', 'aitcf'),
                        'TUIN' => __('Tuin', 'aitcf'),
                        'ZOLDER' => __('Zolder', 'aitcf'),
                        'OVERIG' => __('Overig', 'aitcf')
                    ];

                    // Group items by room_type
                    $grouped_rooms = [];
                    foreach ($household_rooms as $item) {
                        $grouped_rooms[$item['room_type']][] = $item;
                    }
                    ?>

                    <!-- Nav tabs (preserved original order) -->
                    <ul class="nav nav-tabs justify-content-md-cente px-0 px-md-3r" id="myTab" role="tablist">

                      <?php foreach ($ordered_rooms as $room_type => $label) : 
                        $room_slug = sanitize_title($room_type);
                        $active = array_key_first($ordered_rooms) === $room_type ? 'active' : '';
                      ?>
                      <li class="nav-item" role="presentation">
                        <button
                          class="nav-link <?php echo $active; ?>"
                          id="<?php echo $room_slug; ?>-tab"
                          data-bs-toggle="tab"
                          data-bs-target="#<?php echo $room_slug; ?>"
                          type="button"
                          role="tab"
                          aria-controls="<?php echo $room_slug; ?>"
                          aria-selected="<?php echo $active ? 'true' : 'false'; ?>"
                        >
                          <?php echo esc_html($label); ?>
                        </button>
                      </li>
                      <?php endforeach; ?>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content  p-3 border border-top-0">
                      <?php foreach ($ordered_rooms as $room_type => $label) : 
                        $room_slug = sanitize_title($room_type);
                        $active = array_key_first($ordered_rooms) === $room_type ? 'show active' : '';
                        $items = $grouped_rooms[$room_type] ?? [];
                      ?>
                      <div class="tab-pane fade <?php echo $active; ?>" id="<?php echo $room_slug; ?>" role="tabpanel" aria-labelledby="<?php echo $room_slug; ?>-tab">
                        <div class="card card-body px-0 px-sm-3">
                          <div class="row">
                              <?php foreach ($items as $item) : 
                              $input_id = $item['id'];
                              $input_name = sanitize_title($item['item_name']);
                            ?>
                              <div class="col-6 ng-star-inserted">
                                <div class="form-group row">
                                  <label class="col-form-label col-12 col-md-6">
                                    <?php echo esc_html__( $item['item_name'], 'aitcf' ); ?>
                                  </label>
                                  <div class="col-12 col-md-6">
                                    <div class="input-group input-group-m3">
                                      <button class="btn btn-outline-secondary btn-decrease" type="button" aria-label="<?php esc_attr_e('Decrease quantity', 'aitcf'); ?>">
                                        <i class="fas fa-minus" aria-hidden="true"></i>
                                      </button>
                                      <input
                                        input-of="<?php echo esc_attr($room_type); ?>"
                                        type="number"
                                        value="0"
                                        name="<?php echo esc_attr($input_name); ?>"
                                        data-id="<?php echo esc_attr($input_id); ?>"
                                        data-m3="<?php echo esc_attr($item['m3_value']); ?>"
                                        class="alviit_cf_item_quantity form-control form-control quantity-input text-center"
                                      >
                                      <button class="btn btn-outline-secondary btn-increase" type="button" aria-label="<?php esc_attr_e('Increase quantity', 'aitcf'); ?>">
                                        <i class="fas fa-plus" aria-hidden="true"></i>
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            <?php endforeach; ?>


                            <!-- Footer Note -->
                            <div class="col-12">
                              <small class="form-text text-muted">
                                <?php if ($room_type === 'OTHER') : ?>
                                  <?php echo __('Geef in het opmerkingenveld aan om welke objecten het gaat.', 'aitcf'); ?>
                                <?php endif; ?>
                              </small>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-12 col-lg-3">
                    <h5 class="mt-3"><?php echo __('Geschat volume van eigendommen', 'aitcf'); ?></h5>
                    <div class="card bg-light">
                      <div class="card-body text-center">
                        <svg class="svg-inline--fa fa-box-open fa-fw fa-2x" viewBox="0 0 640 512">
                          <path d="M80.4 49.5L320 77.2 559.6 49.5c14.1-1.6 27.5 6.2 33.1 19.2l32 74.7c9.8 22.9-3.5 49.1-27.8 54.7L437.8 234.8c-18.9 4.4-38.6-3.1-49.9-18.9L320 120.9l-67.9 95.1c-11.3 15.8-30.9 23.2-49.9 18.9L43 198c-24.3-5.6-37.6-31.8-27.8-54.7l32-74.7c5.6-13 19-20.8 33.1-19.2zM76.7 81.3l-32 74.7c-2 4.6 .7 9.8 5.6 10.9l159.2 36.7c6.3 1.5 12.9-1 16.6-6.3l65.1-91.2L76.7 81.3zM544 236.7l32-9.1v151c0 22-15 41.2-36.4 46.6l-208 52c-7.6 1.9-15.6 1.9-23.3 0l-208-52C79 419.7 64 400.5 64 378.5v-151l32 9.1V378.5c0 7.3 5 13.7 12.1 15.5L304 443V208c0-8.8 7.2-16 16-16s16 7.2 16 16V443l195.9-49c7.1-1.8 12.1-8.2 12.1-15.5V236.7zM348.8 106.1l65.1 91.2c3.8 5.3 10.3 7.7 16.6 6.3l159.2-36.7c4.9-1.1 7.5-6.4 5.6-10.9l-32-74.7L348.8 106.1z"></path>
                        </svg>
                        <h4 class="font-weight-bold mt-2"><span id="totalVolume2">0</span> m<sup>3</sup></h4>
                      </div>
                    </div>

                    <h5 class="mt-3"><?php echo __('Bijzondere objecten', 'aitcf'); ?></h5>
                    <textarea
                      name="specialObject"
                      id="specialObject"
                      class="form-control"
                      rows="6"
                      placeholder="<?php echo __('Denk aan: zware, breekbare of waardevolle objecten.', 'aitcf'); ?>"
                    ></textarea>

                    <div class="w-100 mt-3 mb-0 alert alert-warning ng-star-inserted">
                      <h5 class="alert-heading">
                        <?php echo __('Let op het volgende', 'aitcf'); ?>
                      </h5>
                      <p class="mb-0">
                        <?php echo __('Geef aan welk meubilair (de)gemonteerd moet worden door de geselecteerde Handyman.', 'aitcf'); ?>
                      </p>
                    </div>

                    <div class="w-100 mt-3 mb-0 alert alert-warning ng-star-inserted">
                      <h5 class="alert-heading">
                        <?php echo __('Niets vergeten?', 'aitcf'); ?>
                      </h5>
                      <p class="mb-0">
                        <?php echo __('Je hebt alleen items uit de woonkamer toegevoegd, controleer ook andere kamers indien nodig.', 'aitcf'); ?>
                      </p>
                    </div>

                </div>
            </div>

              <!--form navigation start-->
              <div style="margin: 32px 0" class="row my-10">
                <div class="col-12 d-flex justify-content-between">
                  <button class="aitcf-prevstep-btn" data-cy="previous" type="button" class="btn btn-secondary btn-lg"><?php _e( 'Terug', 'aitcf' ); ?></button>
                  <h5 class="d-none d-sm-block text-center"><?php _e( 'Hulp nodig bij het invullen van dit formulier? <br> Bel ons op ', 'aitcf' ); ?><a href="tel:09001787">0900 1787</a><br></h5>
                  <button type="button" class="aitcf-nextstep-btn btn btn-success btn-lg ms-5 ng-star-inserted">
                    <span><?php _e( 'Volgende', 'aitcf' ); ?></span>
                  </button>
                </div>
              </div>
              <!--form navigation end-->
        </div>
        <!-- step 3 end -->


        <!-- step 4 start -->
        <div class="step" id="step-4" class="col-12 mb-2 ng-star-inserted">
          <form-options>
            <div class="row ng-star-inserted">

              <!-- Handyman Card -->
              <div class="col-12 col-lg-4 mb-3">
                <div class="card card-clickable">
                    <div class="card-body p-0">
                      <img class="w-100" src="https://release.iaf.studentverhuisservice.nl/assets/image/svs/handyman.jpg">
                    </div>
                    <div class="card-body">
                      <form-group-horizontal style="cursor: pointer;">
                          <div class="form-group-container px-0 px-md-3 row mb-3">
                            <div class="col-4">
                                <label class="col-form-label">
                                  <h3><?php _e( 'Handyman', 'aitcf' ); ?></h3>
                                </label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                  <div class="pt-2 ms-auto">
                                      <div data-cy="handyman" class="form-check form-switch">
                                        <input name="isHandyman" type="checkbox" id="handymanSwitch" class="form-check-input ng-untouched ng-pristine ng-valid">
                                        <label for="handymanSwitch" class="form-check-label"></label>
                                      </div>
                                  </div>
                                </div>
                                <small class="form-text text-muted"></small><small class="form-text text-danger text-right"></small><small class="form-text text-muted text-right"></small>
                            </div>
                          </div>
                          <textarea name="handymanDescription" id="handymanDescription" rows="8" placeholder="<?php _e( 'Please be clear on what needs to be disassembled/assembled. Disassembly is not included in the calculation made on this site, but will be included in the estimate you receive from our office.', 'aitcf' ); ?>"  class="form-control ng-touched ng-pristine ng-invalid ng-star-inserted d-none"></textarea>

                      </form-group-horizontal>
                      <span class="ng-star-inserted">
                          <small id="handymanInfo"><?php _e( 'Wanneer u hulp nodig heeft bij het (de)monteren van uw spullen, kunnen wij u een professionele klusjesman aanbieden. Een klusjesman kan bijvoorbeeld helpen bij het demonteren en opnieuw monteren van meubels, het loskoppelen en verwijderen van verlichting, het verwijderen van gordijnen, het loskoppelen van wasmachines, enz.', 'aitcf' ); ?></small>
                      </span>
                    </div>
                </div>
                <div class="d-flex bg-white">
                  <img class="aitcf-img-md mt-3" src="https://release.iaf.studentverhuisservice.nl/assets/image/avatars/avatar-6.png">
                  <small class="ms-3 mt-3"> "<?php _e( 'Ik werk vaak thuis aan een groot bureau: en dat moest zeker mee. Alles is uit elkaar gehaald en weer in elkaar gezet in mijn nieuwe thuiskantoor. Het lijkt zelfs steviger dan voorheen. 👷', 'aitcf' ); ?>" <br><strong>- <?php _e( 'Marijn Kramer', 'aitcf' ); ?></strong></small>
                </div>
              </div>

              <!-- Moving Lift Card -->
              <div class="col-12 col-lg-4 mb-3">
                <div id="movingLiftClickableCard" class="card card-clickable">
                    <div class="card-body p-0">
                      <img class="w-100" src="https://release.iaf.studentverhuisservice.nl/assets/image/svs/movinglift.jpg">
                    </div>
                    <div class="card-body">
                      <form-group-horizontal style="cursor: pointer;">
                          <div class="form-group-container px-0 px-md-3 row mb-3">
                            <div class="col-4">
                                <label class="col-form-label">
                                  <h3><?php _e( 'Verhuislift', 'aitcf' ); ?></h3>
                                </label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                  <div class="pt-2 ms-auto">
                                      <div data-cy="movingLift" class="form-check form-switch">
                                        <input name="isMoveLift" type="checkbox" id="movingLiftSwitch" class="form-check-input ng-untouched ng-pristine ng-valid">
                                      </div>
                                  </div>
                                </div>
                                <small class="form-text text-muted"></small><small class="form-text text-danger text-right"></small><small class="form-text text-muted text-right"></small>
                            </div>
                          </div>
                      </form-group-horizontal>
                      <span class="ng-star-inserted">
                          <small><?php _e( 'Sla het trappenhuis over met een verhuislift! Verhuizen via de trap is veel minder efficiënt. Soms is het zelfs niet mogelijk om uw meubels via de trap te verplaatsen vanwege het trappenhuis. Een verhuislift wordt vaak gebruikt voor dit soort verhuizingen. Omdat een verhuislift een bereik van 18 meter heeft, kan er veel tijd worden bespaard. En tijd is geld! Bovendien is een verhuislift veiliger dan verhuizen via de trap.', 'aitcf' ); ?></small>
                          
                          <div id="movingLiftNotPossibleAlert" class="w-100 mt-2 mb-0 alert alert-warning">
                            <h5 class="alert-heading"><?php _e( 'Helaas', 'aitcf' ); ?></h5>
                            <p class="mb-0"><?php _e( 'U kunt op de door u aangegeven verdiepingen geen gebruik maken van een verhuislift.', 'aitcf' ); ?></p>
                          </div>
                      </span>
                    </div>
                </div>
                <div class="d-flex bg-white">
                  <img class="aitcf-img-md mt-3" src="https://release.iaf.studentverhuisservice.nl/assets/image/avatars/avatar-7.png">
                  <small class="ms-3 mt-3"> "<?php _e( 'In het begin vond ik het best spannend: al mijn spullen uit het raam. Achteraf was het veiliger dan via de trap; alles zat netjes vast en werd indien nodig aan de lift bevestigd. Ik ben blij dat we het steile en smalle trappenhuis konden overslaan.', 'aitcf' ); ?>" <br><strong>- <?php _e( 'Laura Vossen', 'aitcf' ); ?></strong></small>
                </div>
              </div>

              <!-- Full Service Card -->
              <div class="col-12 col-lg-4 mb-3">
                <div class="card card-clickable">
                    <div class="card-body p-0">
                      <img class="w-100" src="https://release.iaf.studentverhuisservice.nl/assets/image/svs/fullservice.jpg">
                    </div>
                    <div class="card-body">
                      <form-group-horizontal style="cursor: pointer;">
                          <div class="form-group-container px-0 px-md-3 row mb-3">
                            <div class="col-4">
                                <label class="col-form-label">
                                  <h3><?php _e( 'Full Service', 'aitcf' ); ?></h3>
                                </label>
                            </div>
                            <div class="col-8">
                                <div class="input-group">
                                  <div class="pt-2 ms-auto">
                                      <div data-cy="fullService" class="form-check form-switch">
                                        <input name="isFullService" type="checkbox" id="fullServiceSwitch" class="form-check-input ng-untouched ng-pristine ng-valid">
                                        <label for="fullServiceSwitch" class="form-check-label"></label>
                                      </div>
                                  </div>
                                </div>
                                <small class="form-text text-muted"></small><small class="form-text text-danger text-right"></small><small class="form-text text-muted text-right"></small>
                            </div>
                          </div>
                      </form-group-horizontal>
                      <span class="flex-fill">
                          <small><?php _e( 'Bij ons kunt u kiezen tussen een Full-service verhuizing of een budgetverhuizing waarbij u zelf uw verhuizing voorbereidt en uw inboedel transportklaar inpakt. Bij een Full-service verhuizing nemen wij uw verhuizing van A tot Z uit handen: het transportklaar inpakken van uw inboedel, het demonteren van al uw meubels en het vervoeren van uw inboedel. Als u geïnteresseerd bent in een Full-service verhuizing, nemen wij contact met u op om samen de werkzaamheden te inventariseren.', 'aitcf' ); ?></small>
                      </span>
                    </div>
                </div>
                <div class="d-flex bg-white">
                  <img class="aitcf-img-md mt-3" src="https://release.iaf.studentverhuisservice.nl/assets/image/avatars/avatar-12.png">
                  <small class="ms-3 mt-3"> "<?php _e( 'Mijn keuken staat vol met keukenmachines. Van een blender tot een wafelijzer, centrifuge en een luxe baristaset. Ik had echt geen idee hoe ik deze machines goed moest inpakken. Gelukkig wisten de verhuizers precies hoe dat moest! Geweldige service!', 'aitcf' ); ?>" <br><strong>- <?php _e( 'Lieke Smit', 'aitcf' ); ?></strong></small>
                </div>
              </div>

            </div>

            <!-- Alert Section -->
            <div id="step-4-alert" class="row my-3 ng-star-inserted d-none">
              <div class="offset-md-6 col-12 col-md-6">
                <div class="w-100 mt-2 mb-0 alert alert-warning ng-star-inserted">
                  <h5 class="alert-heading"><?php _e( 'Let op', 'aitcf' ); ?></h5>
                  <p class="mb-0"><?php _e( 'Geef aan welk meubelstuk door de door u geselecteerde Handyman moet worden (de)gemonteerd.', 'aitcf' ); ?></p>
                </div>
              </div>
            </div>
          </form-options>

          <!--form navigation start-->
          <div style="margin: 32px 0" class="row my-10">
            <div class="col-12 d-flex justify-content-between">
              <button class="aitcf-prevstep-btn" data-cy="previous" type="button" class="btn btn-secondary btn-lg"><?php _e( 'Terug', 'aitcf' ); ?></button>
              <h5 class="d-none d-sm-block text-center"><?php _e( 'Hulp nodig bij het invullen van dit formulier? <br> Bel ons op ', 'aitcf' ); ?><a href="tel:09001787">0900 1787</a><br></h5>
              <button type="button" class="aitcf-nextstep-btn btn btn-success btn-lg ms-5 ng-star-inserted">
                <span><?php _e( 'Volgende', 'aitcf' ); ?></span>
              </button>
            </div>
          </div>
          <!--form navigation end-->
        </div>
        <!-- step 4 end -->


        <!-- step 5 start -->
        <div class="step" id="step-5" class="col-12 mb-2 ng-star-inserted">
            <div class="offset-lg-2 col-lg-8">
                <div class="card card-body">
                    <h4 class="card-title"><span><?php echo esc_html__( 'Contactgegevens', 'aitcf' ); ?></span></h4>
                    <form-customer class="ng-untouched ng-pristine ng-valid">
                        <form-email class="ng-star-inserted">
                            <form-floating>
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <div class="form-floating flex-grow-1">
                                            <input required name="email" id="email" type="email" placeholder="<?php echo esc_attr__( 'E-mailadres', 'aitcf' ); ?>" data-cy="email" autocomplete="email" input-validation="" class="form-control ng-untouched ng-pristine ng-valid">
                                            <label><?php echo esc_html__( 'E-mailadres', 'aitcf' ); ?></label>
                                            <div class="invalid-feedback">
                                                <span><?php echo esc_html__( 'Graag een correct email adres opgeven', 'aitcf' ); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted"></small>
                                    <small class="form-text text-danger text-right"></small>
                                    <small class="form-text text-muted text-right"></small>
                                </div>
                            </form-floating>
                        </form-email>
                        <div class="row ng-star-inserted">
                            <div class="col-12 col-sm-4">
                                <form-floating>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <div class="form-floating flex-grow-1">
                                                <input required name="firstName" id="firstName"  type="text" placeholder="<?php echo esc_attr__( 'Voornaam', 'aitcf' ); ?>" data-cy="nameFirst" autocomplete="given-name" input-validation="" class="form-control ng-untouched ng-pristine ng-valid">
                                                <label><?php echo esc_html__( 'Voornaam', 'aitcf' ); ?></label>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted"></small>
                                        <small class="form-text text-danger text-right"></small>
                                        <small class="form-text text-muted text-right"></small>
                                    </div>
                                </form-floating>
                            </div>
                            <div class="col-12 col-sm-4">
                                <form-floating>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <div class="form-floating flex-grow-1">
                                                <input name="middleName" id="middleName" type="text" placeholder="<?php echo esc_attr__( 'Tussenvoegsels', 'aitcf' ); ?>" data-cy="nameMiddle" autocomplete="additional-name" input-validation="" class="form-control ng-untouched ng-pristine ng-valid">
                                                <label><?php echo esc_html__( 'Tussenvoegsels', 'aitcf' ); ?></label>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted"></small>
                                        <small class="form-text text-danger text-right"></small>
                                        <small class="form-text text-muted text-right"></small>
                                    </div>
                                </form-floating>
                            </div>
                            <div class="col-12 col-sm-4">
                                <form-floating>
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <div class="form-floating flex-grow-1">
                                                <input required name="lastName" id="lastName" type="text" placeholder="<?php echo esc_attr__( 'Achternaam', 'aitcf' ); ?>" data-cy="nameLast" autocomplete="family-name" input-validation="" class="form-control ng-untouched ng-pristine ng-valid">
                                                <label><?php echo esc_html__( 'Achternaam', 'aitcf' ); ?></label>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted"></small>
                                        <small class="form-text text-danger text-right"></small>
                                        <small class="form-text text-muted text-right"></small>
                                    </div>
                                </form-floating>
                            </div>
                        </div>
                        <form-floating class="ng-star-inserted">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="form-floating flex-grow-1">
                                        <input required name="telephone" id="telephone" type="tel" placeholder="<?php echo esc_attr__( 'Telefoonnummer', 'aitcf' ); ?>" data-cy="mobile" autocomplete="tel-national" input-validation="" class="form-control ng-untouched ng-pristine ng-valid">
                                        <label><?php echo esc_html__( 'Telefoonnummer', 'aitcf' ); ?></label>
                                        <div class="invalid-feedback"><?php echo esc_html__( 'Geef een geldig nummer op (min. 8 tekens)', 'aitcf' ); ?></div>
                                    </div>
                                </div>
                                <small class="form-text text-muted"><span help-text=""><?php echo esc_html__( 'Als je extra telefoonnummers of andere contactgegevens hebt, vermeld deze dan in het opmerkingenveld.', 'aitcf' ); ?></span></small>
                                <small class="form-text text-danger text-right"></small>
                                <small class="form-text text-muted text-right"></small>
                            </div>
                        </form-floating>
                        <form-floating class="ng-star-inserted">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <div class="form-floating flex-grow-1">
                                        <select name="contactPreference" id="contactPreference" class="form-select ng-untouched ng-pristine ng-valid">
                                            <option value="0: null"><?php echo esc_html__( 'Geen voorkeur', 'aitcf' ); ?></option>
                                            <option value="email"><?php echo esc_html__( 'E-mail', 'aitcf' ); ?></option>
                                            <option value="phone"><?php echo esc_html__( 'Telefoon', 'aitcf' ); ?></option>
                                        </select>
                                        <label><?php echo esc_html__( 'Contactvoorkeur', 'aitcf' ); ?></label>
                                    </div>
                                </div>
                                <small class="form-text text-muted"></small>
                                <small class="form-text text-danger text-right"></small>
                                <small class="form-text text-muted text-right"></small>
                            </div>
                        </form-floating>
                        <div class="row mb-3 ng-star-inserted">
                            <div class="col-4"><label><?php echo esc_html__( 'Bent u een bedrijf?', 'aitcf' ); ?></label></div>
                            <div class="col-8">
                                <div class="form-check form-switch">
                                    <input id="isBusiness" name="isBusiness" type="checkbox" data-cy="companyQuestion" class="form-check-input ng-valid ng-dirty ng-touched" data-gtm-form-interact-field-id="5">
                                    <label class="form-check-label text-muted"><?php echo esc_html__( 'Dit is optioneel', 'aitcf' ); ?></label>
                                </div>
                            </div>
                        </div>
                        <!--is business section form start-->
                        <div class="d-none" id="isBusinessSection">
                            <form-floating class="ng-star-inserted">
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <div class="form-floating flex-grow-1">
                                            <input id="nameOfSVSEmployee" name="nameOfSVSEmployee" type="text" placeholder="<?php echo esc_attr__( 'Naam van SVS-medewerker (optioneel)', 'aitcf' ); ?>" data-cy="accountManager" autocomplete="off" input-validation="" class="form-control ng-untouched ng-pristine ng-valid">
                                            <label><?php echo esc_html__( 'Heeft u al contact gehad met een SVS-medewerker?', 'aitcf' ); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </form-floating>
                            <div class="row ng-star-inserted">
                                <div class="col-12 col-sm-6">
                                    <form-floating>
                                        <div class="form-group mb-3">
                                            <div class="input-group">
                                                <div class="form-floating flex-grow-1">
                                                    <input name="businessName" id="businessName" type="text" placeholder="<?php echo esc_attr__( 'Bedrijfsnaam (optioneel)', 'aitcf' ); ?>" data-cy="nameCompany" autocomplete="organization" input-validation="" class="form-control ng-pristine ng-valid ng-touched is-valid">
                                                    <label><?php echo esc_html__( 'Bedrijfsnaam (optioneel)', 'aitcf' ); ?></label>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted"></small>
                                            <small class="form-text text-danger text-right"></small>
                                            <small class="form-text text-muted text-right"></small>
                                        </div>
                                    </form-floating>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <form-floating>
                                        <div class="form-group mb-3">
                                            <div class="input-group">
                                                <div class="form-floating flex-grow-1">
                                                    <input id="kvkNumber" name="kvkNumber" type="text" placeholder="<?php echo esc_attr__( 'KVK-nummer', 'aitcf' ); ?>" data-cy="kvkCompany" autocomplete="off" input-validation="" class="form-control ng-pristine ng-valid ng-touched is-valid">
                                                    <label><?php echo esc_html__( 'KVK-nummer', 'aitcf' ); ?></label>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted"></small>
                                            <small class="form-text text-danger text-right"></small>
                                            <small class="form-text text-muted text-right"></small>
                                        </div>
                                    </form-floating>
                                </div>
                            </div>
                        </div>
                        <!--is business section form start-->
                    </form-customer>
                </div>
            </div>
            <!--form navigation start-->
            <div style="margin: 32px 0" class="row my-10">
                <div class="col-12 d-flex justify-content-between">
                    <button class="aitcf-prevstep-btn" data-cy="previous" type="button" class="btn btn-secondary btn-lg"><?php echo esc_html__( 'Terug', 'aitcf' ); ?></button>
                    <h5 class="d-none d-sm-block text-center"><?php echo esc_html__( 'Hulp nodig bij het gebruik van dit formulier?', 'aitcf' ); ?><br> <?php echo esc_html__( 'Bel ons op', 'aitcf' ); ?> <a href="tel:09001787">0900 1787</a><br></h5>
                    <button type="button" class="aitcf-nextstep-btn btn btn-success btn-lg ms-5 ng-star-inserted">
                        <span><?php echo esc_html__( 'Volgende', 'aitcf' ); ?></span>
                    </button>
                </div>
            </div>
            <!--form navigation end-->
        </div>
        <!-- step 5 end -->



        <!-- step 6 start -->
        <div class="step" id="step-6" class="col-12 mb-2 ng-star-inserted">
            <form-result>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <h5 class="mt-3"><?php echo esc_html__('Uw verhuizing', 'aitcf'); ?></h5>
                     <result-tiles>
                    <div class="g-2 row row-cols-3 text-center">
                        <!-- SVG icons remain unchanged -->
                        <div class="col ng-star-inserted">
                          <svg role="img" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="calendar" class="svg-inline--fa fa-calendar fa-fw fa-2x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M112 0c8.8 0 16 7.2 16 16l0 48 192 0 0-48c0-8.8 7.2-16 16-16s16 7.2 16 16l0 48 32 0c35.3 0 64 28.7 64 64l0 32 0 32 0 256c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 192l0-32 0-32C0 92.7 28.7 64 64 64l32 0 0-48c0-8.8 7.2-16 16-16zM416 192L32 192l0 256c0 17.7 14.3 32 32 32l320 0c17.7 0 32-14.3 32-32l0-256zM384 96L64 96c-17.7 0-32 14.3-32 32l0 32 384 0 0-32c0-17.7-14.3-32-32-32z"></path></svg>
                          <!-- Card content unchanged -->
                          <div id="calc-date">10 jun. 2025</div>
                        </div>
                        <div class="col ng-star-inserted">
                          <svg role="img" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="clock" class="svg-inline--fa fa-clock fa-fw fa-2x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M480 256A224 224 0 1 1 32 256a224 224 0 1 1 448 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM240 112l0 144c0 5.3 2.7 10.3 7.1 13.3l96 64c7.4 4.9 17.3 2.9 22.2-4.4s2.9-17.3-4.4-22.2L272 247.4 272 112c0-8.8-7.2-16-16-16s-16 7.2-16 16z"></path></svg>
                          <!-- Card content unchanged -->
                          <div id="calc-time">09:00</div>
                        </div>
                        <div class="col ng-star-inserted">
                          <svg role="img" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="box-open" class="svg-inline--fa fa-box-open fa-fw fa-2x" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M80.4 49.5L320 77.2 559.6 49.5c14.1-1.6 27.5 6.2 33.1 19.2l32 74.7c9.8 22.9-3.5 49.1-27.8 54.7L437.7 234.8c-18.9 4.4-38.6-3.1-49.9-18.9L320 120.9l-67.9 95.1c-11.3 15.8-30.9 23.2-49.9 18.9L43 198c-24.3-5.6-37.6-31.8-27.8-54.7l32-74.7c5.6-13 19-20.8 33.1-19.2zM76.7 81.3l-32 74.7c-2 4.6 .7 9.8 5.6 10.9l159.2 36.7c6.3 1.5 12.9-1 16.6-6.3l65.1-91.2L76.7 81.3zM544 236.7l32-9.1 0 151c0 22-15 41.2-36.4 46.6l-208 52c-7.6 1.9-15.6 1.9-23.3 0l-208-52C79 419.7 64 400.6 64 378.5l0-151 32 9.1 0 141.8c0 7.3 5 13.7 12.1 15.5L304 443l0-235c0-8.8 7.2-16 16-16s16 7.2 16 16l0 235 195.9-49c7.1-1.8 12.1-8.2 12.1-15.5l0-141.8zM348.8 106.1l65.1 91.2c3.8 5.3 10.3 7.7 16.6 6.3l159.2-36.7c4.9-1.1 7.5-6.4 5.6-10.9l-32-74.7L348.8 106.1z"></path></svg>
                          <!-- Card content unchanged -->
                          <div><span id="calc-volume">2</span> m<sup>3</sup></div>
                        </div>
                    </div>
                  </result-tiles>
                        
                        <h5 class="mt-3"><?php echo esc_html__('Extra opties', 'aitcf'); ?></h5>
                      <div class="card card-body">
                        <span data-cy="handyman">
                           
                            <fa-icon id="crossHandyman" class="ng-fa-icon text-danger ng-star-inserted">
                              <svg role="img" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="xmark" class="svg-inline--fa fa-xmark fa-fw" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                  <path fill="currentColor" d="M324.5 411.1c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L214.6 256 347.1 123.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 233.4 59.5 100.9c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L169.4 256 36.9 388.5c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L192 278.6 324.5 411.1z"></path>
                              </svg>
                            </fa-icon>

                           <fa-icon id="checkedHandyman" class="ng-fa-icon text-success ng-star-inserted">
                              <svg role="img" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="check" class="svg-inline--fa fa-check fa-fw" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                  <path fill="currentColor" d="M443.3 100.7c6.2 6.2 6.2 16.4 0 22.6l-272 272c-6.2 6.2-16.4 6.2-22.6 0l-144-144c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L160 361.4 420.7 100.7c6.2-6.2 16.4-6.2 22.6 0z"></path>
                              </svg>
                            </fa-icon>


                            &nbsp; <span><?php echo esc_html__('Klusjesman', 'aitcf'); ?></span>
                        </span>
                        <span data-cy="movingLift">
                           
                            <fa-icon id="crossMovingLift" class="ng-fa-icon text-danger ng-star-inserted">
                              <svg role="img" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="xmark" class="svg-inline--fa fa-xmark fa-fw" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                  <path fill="currentColor" d="M324.5 411.1c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L214.6 256 347.1 123.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 233.4 59.5 100.9c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L169.4 256 36.9 388.5c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L192 278.6 324.5 411.1z"></path>
                              </svg>
                            </fa-icon>

                          <fa-icon id="checkedMovingLift" class="ng-fa-icon text-success ng-star-inserted">
                              <svg role="img" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="check" class="svg-inline--fa fa-check fa-fw" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                  <path fill="currentColor" d="M443.3 100.7c6.2 6.2 6.2 16.4 0 22.6l-272 272c-6.2 6.2-16.4 6.2-22.6 0l-144-144c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L160 361.4 420.7 100.7c6.2-6.2 16.4-6.2 22.6 0z"></path>
                              </svg>
                            </fa-icon>

                             &nbsp; <span><?php echo esc_html__('Verhuislift', 'aitcf'); ?></span>
                        </span>
                        <span data-cy="fullService">

                            <fa-icon id="crossFullService" class="ng-fa-icon text-danger ng-star-inserted">
                               <svg role="img" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="xmark" class="svg-inline--fa fa-xmark fa-fw" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                  <path fill="currentColor" d="M324.5 411.1c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6L214.6 256 347.1 123.5c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L192 233.4 59.5 100.9c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6L169.4 256 36.9 388.5c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L192 278.6 324.5 411.1z"></path>
                               </svg>
                             </fa-icon>
                            
                            <fa-icon id="checkedFullService" class="ng-fa-icon text-success ng-star-inserted">
                              <svg role="img" aria-hidden="true" focusable="false" data-prefix="fal" data-icon="check" class="svg-inline--fa fa-check fa-fw" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                  <path fill="currentColor" d="M443.3 100.7c6.2 6.2 6.2 16.4 0 22.6l-272 272c-6.2 6.2-16.4 6.2-22.6 0l-144-144c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L160 361.4 420.7 100.7c6.2-6.2 16.4-6.2 22.6 0z"></path>
                              </svg>
                            </fa-icon>
                             &nbsp; <span><?php echo esc_html__('Volledige Service', 'aitcf'); ?></span>
                        </span>
                      </div>

                        <h5 class="mt-3"><?php echo esc_html__('Vragen of opmerkingen', 'aitcf'); ?></h5>
                        <textarea name="questionOrComment" id="questionOrComment" rows="6" 
                            placeholder="<?php echo esc_attr__('Denk aan: meereizen, alternatieve verhuisdagen, extra telefoonnummers/contactpersonen, enz.', 'aitcf'); ?>" 
                            class="form-control ng-untouched ng-pristine ng-valid"></textarea>
                    </div>

                    <div class="col-12 col-lg-6 ng-star-inserted">
                        <h5 class="mt-3"><?php echo esc_html__('Offerte', 'aitcf'); ?></h5>
                        <div class="card card-body p-0">
                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td><?php echo esc_html__('Laadtijd', 'aitcf'); ?></td>
                                        <td></td>
                                       <td id="calc_loading_time" class="text-right">0:00 </td>
                                    </tr>
                                    <tr class="ng-star-inserted">
                                        <td><?php echo esc_html__('Reistijd', 'aitcf'); ?></td>
                                        <td></td>
                                        <td id="calc_travel_time" class="text-right">0:00 </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo esc_html__('Lostijd', 'aitcf'); ?></td>
                                        <td></td>
                                        <td id="calc_unloading_time" class="text-right">0:00 </td>
                                    </tr>
                                    <tr class="ng-star-inserted">
                                        <td><?php echo esc_html__('Totaal uren (min. 2 uur)', 'aitcf'); ?></td>
                                        <td></td>
                                        <td id="calc_total_hours" class="text-right">2:00</td>
                                    </tr>
                                    <tr class="ng-star-inserted">
                                        <td><?php echo esc_html__('reiskosten', 'aitcf'); ?></td>
                                        <td></td>
                                        <td id="calc_travel_cost" data-cy="priceTotal" class="text-right"> €&nbsp;00</td>
                                    </tr>
                                    <tr class="ng-star-inserted">
                                        <td><?php echo esc_html__('Geschatte prijs, exclusief belasting', 'aitcf'); ?></td>
                                        <td></td>
                                        <td id="calc_total_price" data-cy="priceTotal" class="text-right"> €&nbsp;216,00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3 form-check">
                            <input name="termAndCondition" data-cy="terms" type="checkbox" 
                                class="form-check-input ng-untouched ng-pristine ng-invalid" 
                                required="true">
                            <label class="form-check-label">
                                <?php
                                echo wp_kses(
                                    sprintf(
                                        __('Ik heb de %1$salgemene voorwaarden%2$s gelezen en ga hiermee akkoord', 'aitcf'),
                                        '<a href="/" target="_blank">',
                                        '</a>'
                                    ),
                                    array(
                                        'a' => array(
                                            'href' => array(),
                                            'target' => array()
                                        )
                                    )
                                );
                                ?>
                            </label>
                        </div>
                    </div>
                </div>
            </form-result>

            <!--form navigation start-->
            <div style="margin: 32px 0" class="row my-10">
                <div class="col-12 d-flex justify-content-between">
                    <button class="aitcf-prevstep-btn" data-cy="previous" type="button" class="btn btn-secondary btn-lg">
                        <?php echo esc_html__('Terug', 'aitcf'); ?>
                    </button>
                    
                    <h5 class="d-none d-sm-block text-center">
                        <?php
                        echo wp_kses(
                            __('Hulp nodig bij dit formulier? <br> Bel ons op <a href="tel:09001787">0900 1787</a><br>', 'aitcf'),
                            array(
                                'br' => array(),
                                'a' => array(
                                    'href' => array()
                                )
                            )
                        );
                        ?>
                    </h5>

                    <button type="submit" id="btn-aitcf-multiStepForm" class="btn btn-success btn-lg ms-5 ng-star-inserted">
                        <span><?php echo esc_html__('Verstuur zonder verplichtingen', 'aitcf'); ?></span>
                    </button>
                </div>
            </div>
            <!--form navigation end-->
        </div>
        <!-- step 6 end -->

        
        </form>
        </div>

        <!-- created by -->
        <div class="row my-3">
            <small class="col-12 text-center" style="font-size: 8px">
                <?php
                echo wp_kses(
                    sprintf(
                        __('This software is created by %s', 'aitcf'),
                        '<a target="_blank" href="https://woodl.nl/">Woodland Software B.V.</a>'
                    ),
                    array(
                        'a' => array(
                            'href' => array(),
                            'target' => array()
                        )
                    )
                );
                ?>
            </small>
            
            <small class="col-12 text-center" style="font-size: 8px">
                <?php
                echo wp_kses(
                    sprintf(
                        __('This site is protected by reCAPTCHA and the Google %1$s and %2$s apply.', 'aitcf'),
                        '<a target="_blank" href="https://policies.google.com/privacy">' . esc_html__('Privacy Policy', 'aitcf') . '</a>',
                        '<a target="_blank" href="https://policies.google.com/terms">' . esc_html__('Terms of Service', 'aitcf') . '</a>'
                    ),
                    array(
                        'a' => array(
                            'href' => array(),
                            'target' => array()
                        )
                    )
                );
                ?>
            </small>
        </div>
        <!-- /created by -->
      </removal-step>
    </div>
