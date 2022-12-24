<nav class="navbar" role="navigation" aria-label="main navigation">
    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
        <a class="navbar-item" href="/">
            Home
        </a>
        <a class="navbar-item">
            Documentation
        </a>
        <div class="navbar-item has-dropdown is-hoverable">
            <a class="navbar-link">
            More
            </a>
            <div class="navbar-dropdown">
            <a class="navbar-item">
                About
            </a>
            <a class="navbar-item">
                Jobs
            </a>
            <a class="navbar-item">
                Contact
            </a>
            <hr class="navbar-divider">
            <a class="navbar-item">
                Report an issue
            </a>
            </div>
        </div>
        </div>
        <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
            <?php if(!user()): ?>
                <a class="button is-primary" href="/signup">
                    <strong>Sign up</strong>
                </a>
            <?php endif; ?>
            <?php if(user()): ?>
                <form action="/logout" method="POST" >
                    <button type="submit" class="button is-light">
                        Logout
                    </button>
                </form>
            <?php endif; ?>
            <?php if(!user()): ?>
                <a class="button is-light" href="/login">
                    Log in
                </a>
            <?php endif; ?>
            </div>
        </div>
        </div>
    </div>
</nav>