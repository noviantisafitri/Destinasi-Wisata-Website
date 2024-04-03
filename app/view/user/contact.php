<section>
    <div class="container-fluid px-5 my-5">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <!-- <div class="card border-0 rounded-3 shadow-lg overflow-hidden"> -->
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-12 p-4">
                            <div class="text-center">
                                <p class="section-subtitle"></p>

                                <h2 class="h2 section-title">Contact US</h2>

                                <p class="section-text">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea neque distinctio, accusantium sunt veritatis commodi molestias? Mollitia nam distinctio amet aliquid culpa consequuntur quisquam modi ipsum, voluptas exercitationem natus minus.
                                </p>
                            </div>

                            <form id="contactForm" data-sb-form-api-token="API_TOKEN">

                                <!-- Name Input -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="first-name" type="text" placeholder="First Name" data-sb-validations="required" />
                                            <label for="first-name">First Name</label>
                                            <div class="invalid-feedback" data-sb-feedback="first-name:required">First Name is required.</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="last-name" type="text" placeholder="Last Name" data-sb-validations="required" />
                                            <label for="last-name">Last Name</label>
                                            <div class="invalid-feedback" data-sb-feedback="last-name:required">Last Name is required.</div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Email Input -->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="emailAddress" type="email" placeholder="Email Address" data-sb-validations="required,email" />
                                    <label for="emailAddress">Email Address</label>
                                    <div class="invalid-feedback" data-sb-feedback="emailAddress:required">Email Address is required.</div>
                                    <div class="invalid-feedback" data-sb-feedback="emailAddress:email">Email Address Email is not valid.</div>
                                </div>

                                <!-- Message Input -->
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="message" type="text" placeholder="Message" style="height: 10rem;" data-sb-validations="required"></textarea>
                                    <label for="message">Message</label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required">Message is required.</div>
                                </div>

                                <!-- Submit button -->
                                <div class="form-group d-flex justify-content-center">
                                    <div>
                                        <button class="btn btn-primary btn-lg mx-auto" id="submitButton" type="submit" style="padding: 10px 40px;">Submit</button>
                                    </div>
                                </div>

                            </form>
                            <!-- End of contact form -->

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script src="/destinasi/public/assets/js/contact.js"></script>