import "./Navbar_Blue.css";
const Navbar_Blue = () => {
  return (
<>
      <nav className="navbar navbar-expand-lg fixed-top simple-navbar">
        <div className="container-fluid px-lg-5">
          {/* Logo */}
          <a className="navbar-brand" href="#">
            <img src="/CSPD.png" alt="Logo" className="brand-logo" />
          </a>

          {/* Toggler */}
          <button
            className="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#simpleMobileMenu"
          >
            <span className="navbar-toggler-icon"></span>
          </button>

          {/* ================= DESKTOP MENU ================= */}
          <div className="collapse navbar-collapse d-none d-lg-flex">
            <ul className="navbar-nav ms-auto align-items-center">
              <li className="nav-item">
                <a className="nav-link" href="#">Home</a>
              </li>

              <li className="nav-item dropdown">
                <a className="nav-link" href="#">Programs</a>
                <ul className="dropdown-menu">
                  <li><a className="dropdown-item" href="#">Undergraduate</a></li>
                  <li><a className="dropdown-item" href="#">Graduate</a></li>
                  <li><a className="dropdown-item" href="#">PhD</a></li>
                </ul>
              </li>

              <li className="nav-item">
                <a className="nav-link" href="#">About</a>
              </li>

              <li className="nav-item">
                <a className="nav-link" href="#">Contact Us</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      {/* ================= MOBILE OFFCANVAS ================= */}
      <div
        className="offcanvas offcanvas-end d-lg-none"
        id="simpleMobileMenu"
      >
        <div className="offcanvas-header">
          <h5 className="offcanvas-title">Menu</h5>
          <button
            type="button"
            className="btn-close"
            data-bs-dismiss="offcanvas"
          ></button>
        </div>

        <div className="offcanvas-body">
          <ul className="navbar-nav">
            <li className="nav-item">
              <a className="nav-link" href="#">Home</a>
            </li>

            <li className="nav-item">
              <button
                className="nav-link w-100 text-start"
                data-bs-toggle="collapse"
                data-bs-target="#simplePrograms"
              >
                Programs
              </button>

              <div className="collapse ps-3" id="simplePrograms">
                <a className="nav-link" href="#">Undergraduate</a>
                <a className="nav-link" href="#">Graduate</a>
                <a className="nav-link" href="#">PhD</a>
              </div>
            </li>

            <li className="nav-item">
              <a className="nav-link" href="#">About</a>
            </li>

            <li className="nav-item">
              <a className="nav-link" href="#">Contact Us</a>
            </li>
          </ul>
        </div>
      </div>
    </>
  );
};

export default Navbar_Blue;
