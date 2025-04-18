<div class="footer-container">
    <div class="footer">
        <div class="footer-content">
            <div class="footer-section-about">
                <h3>About Us</h3><br>
                <p>Boothopia is a platform that connects event organizers with booth vendors. We aim to make the process of organizing events easier and more efficient.</p>
            </div>
            <div class="footer-section-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/about">About</a></li>
                    @can('isOrganiser')
                    <li><a href="/contact">Contact</a></li>
                    @endcan
                    @can('isAdmin')
                    <li><a href="/contact">Contact</a></li>
                    @endcan
                    @can('isRequester')
                    <li><a href="/contact">Contact</a></li>
                    @endcan
                    <li><a href="/login">Login</a></li>
                    <li><a href="/Sign-in">Sign In</a></li>
                </ul>
            </div>
            <div class="footer-section-contact">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                    <li><a href="#" class="fa fa-linkedin"></a></li>
                </ul>
            </div>
        </div>
        <div class="container text-gray-dark text-center border-t border-gray-lightest py-20">
                <div class="footer-policy">
                    &copy; Copyright 2025 Boothopia | All Rights Reserved
                </div>
        </div>
    </div>
</div>