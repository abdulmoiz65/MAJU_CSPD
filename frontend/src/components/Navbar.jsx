import { useEffect, useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import "./Navbar.css";

const Navbar = () => {
  const [scrolled, setScrolled] = useState(false);
  const navigate = useNavigate();

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 50);
    window.addEventListener("scroll", onScroll);
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  const closeOffcanvasAndNavigate = (path) => {
    const offcanvasElement = document.getElementById("mobileMenu");
    if (offcanvasElement) {
      const offcanvas = window.bootstrap.Offcanvas.getInstance(offcanvasElement);
      if (offcanvas) {
        offcanvas.hide();
      }
    }
    navigate(path);
  };

  return (
    <>
      <nav
        className={`navbar navbar-expand-lg fixed-top custom-navbar ${
          scrolled ? "scrolled" : ""
        }`}
      >
        <div className="container-fluid px-lg-5">
          <a className="navbar-brand" href="#">
            <img src="/CSPD.png" alt="MAJU Logo" className="brand-logo" />
          </a>

          <button
            className="navbar-toggler"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#mobileMenu"
          >
            <span className="navbar-toggler-icon"></span>
          </button>

          {/* Desktop Menu */}
          <div className="collapse navbar-collapse d-none d-lg-flex">
            <ul className="navbar-nav ms-auto align-items-center">
              <li className="nav-item">
                <Link className="nav-link" to="/">
                  Home
                </Link>
              </li>
              <li className="nav-item dropdown">
                <a className="nav-link" href="#">
                  About
                </a>
                <ul className="dropdown-menu">
                         <li>
                    <Link className="dropdown-item" to="about_maju">
                      About MAJU
                    </Link>
                  </li>
                  <li>
                    <Link className="dropdown-item" to="about">
                      About CSPD
                    </Link>
                  </li>
                  <li>
                    <Link className="dropdown-item" to="president_message">
                      President message
                    </Link>
                  </li>
              
                </ul>
              </li>

              <li className="nav-item dropdown">
                <a className="nav-link" href="#">
                  Program
                </a>
                <ul className="dropdown-menu">
                  <li>
                    <Link className="dropdown-item" to="upcoming_programs">
                      Upcoming Programs
                    </Link>
                  </li>
                    <li>
                    <Link className="dropdown-item" to="Navttc">
                        Navttc Programs
                    </Link>
                  </li>
                  <li>
                    <a className="dropdown-item" href="#">
                      Download Calender
                    </a>
                  </li>
              
                </ul>
              </li>

              <li className="nav-item dropdown">
                <a className="nav-link" href="#">
                  Enrollments
                </a>
                <ul className="dropdown-menu">
                  <li>
                    <Link className="dropdown-item" to="cancellation_policy">
                        Cancellation Policy
                    </Link>
                  </li>
                 
                 
              
                </ul>
              </li>
              <li className="nav-item">
                <Link className="nav-link" to="contact">
                  Contact Us
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      {/* Mobile Offcanvas ONLY */}
      <div className="offcanvas offcanvas-end d-lg-none" id="mobileMenu">
        <div className="offcanvas-header">
          <h5 className="offcanvas-title">MAJU CSPD</h5>
          <button
            type="button"
            className="btn-close"
            data-bs-dismiss="offcanvas"
          ></button>
        </div>
        <div className="offcanvas-body">
          <ul className="navbar-nav">
            <li className="nav-item">
              <a className="nav-link" onClick={() => closeOffcanvasAndNavigate("/")} style={{ cursor: "pointer" }}>
                Home
              </a>
            </li>
            
            <li className="nav-item">
              <button
                className="nav-link w-100 text-start"
                data-bs-toggle="collapse"
                data-bs-target="#mobileAbout"
                aria-expanded="false"
              >
                About
              </button>
              <div className="collapse ps-3" id="mobileAbout">
                <a className="nav-link" onClick={() => closeOffcanvasAndNavigate("/about_maju")} style={{ cursor: "pointer" }}>
                  About MAJU
                </a>
                <a className="nav-link" onClick={() => closeOffcanvasAndNavigate("/about")} style={{ cursor: "pointer" }}>
                  About CSPD
                </a>
                <a className="nav-link" onClick={() => closeOffcanvasAndNavigate("/president_message")} style={{ cursor: "pointer" }}>
                  President Message
                </a>
              </div>
            </li>

            <li className="nav-item">
              <button
                className="nav-link w-100 text-start"
                data-bs-toggle="collapse"
                data-bs-target="#mobilePrograms"
                aria-expanded="false"
              >
                Program
              </button>
              <div className="collapse ps-3" id="mobilePrograms">
                <a className="nav-link" onClick={() => closeOffcanvasAndNavigate("/upcoming_programs")} style={{ cursor: "pointer" }}>
                  Upcoming Programs
                </a>
                <a className="nav-link" onClick={() => closeOffcanvasAndNavigate("/Navttc")} style={{ cursor: "pointer" }}>
                  Navttc Programs
                </a>
                <a className="nav-link" href="#">
                  Download Calender
                </a>
              </div>
            </li>

            <li className="nav-item">
              <button
                className="nav-link w-100 text-start"
                data-bs-toggle="collapse"
                data-bs-target="#mobileEnrollments"
                aria-expanded="false"
              >
                Enrollments
              </button>
              <div className="collapse ps-3" id="mobileEnrollments">
                <a className="nav-link" onClick={() => closeOffcanvasAndNavigate("/cancellation_policy")} style={{ cursor: "pointer" }}>
                  Cancellation Policy
                </a>
              </div>
            </li>

            <li className="nav-item">
              <a className="nav-link" onClick={() => closeOffcanvasAndNavigate("/contact")} style={{ cursor: "pointer" }}>
                Contact Us
              </a>
            </li>
          </ul>
        </div>
      </div>
    </>
  );
};

export default Navbar;
