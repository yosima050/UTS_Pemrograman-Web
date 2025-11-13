<?php include 'header.php'; ?>

<style>
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .main-header {
        position: relative !important; 
        background-color: #212529;
    }

    main.flex-fill {
        flex: 1 1 auto; 
    }
</style>
<main class="flex-fill">
    <section class="pricing-section py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">
                    One simple plan unlocks everything.<br>
                    No bundles. No add-ons.
                </h2>
            </div>
            
            <div class="row">

                <div class="col-lg-4 mb-4">
                    <div class="card h-100 text-center shadow" style="border: 2px solid #C3F73A;">
                        <div class="card-header border-bottom-0" style="background-color: #C3F73A; color: #000;">
                            <h4 class="fw-normal">Free</h4>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Limited downloads</li>
                                <li>Standard resolution</li>
                                <li>Basic support</li>
                            </ul>
                            <button class="btn btn-lg mt-auto" style="background-color: #C3F73A; border-color: #C3F73A; color: #000;" onclick="window.location.href='index.php'">Continue Free</button>  

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card h-100 text-center shadow" style="border: 2px solid #C3F73A;">
                        <div class="card-header border-bottom-0" style="background-color: #C3F73A; color: #000;">
                            <h4 class="fw-normal">Pro</h4>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title pricing-card-title">$4<small class="text-muted fw-light">/mo</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Unlimited downloads</li>
                                <li>High resolution</li>
                                <li>Priority support</li>
                                <li>Ad-free experience</li>
                            </ul>
                            <button class="btn btn-lg mt-auto" style="background-color: #C3F73A; border-color: #C3F73A; color: #000;" onclick="alert('Purchase is unavailable at the moment.');">Get Pro</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="card h-100 text-center shadow" style="border: 2px solid #C3F73A;">
                        <div class="card-header border-bottom-0" style="background-color: #C3F73A; color: #000;">
                            <h4 class="fw-normal">Team</h4>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h3 class="card-title pricing-card-title">$10<small class="text-muted fw-light">/mo</small></h3>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>Everything in Pro</li>
                                <li>Team management</li>
                                <li>Collaboration tools</li>
                                <li>Dedicated support</li>
                            </ul>
                        <button class="btn btn-lg mt-auto" style="background-color: #C3F73A; border-color: #C3F73A; color: #000;" onclick="alert('Purchase is unavailable at the moment.');">Get Team</button>                        
                    </div>
                </div>

            </div> </div> </section>
</main>

<?php include 'footer.php'; ?>