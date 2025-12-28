import React from "react";
import { Link } from "react-router-dom";
import "./Footer.css";

// Lucide Icons
import {
  Facebook,
  Linkedin,
  Instagram,
  Youtube,
  Twitter,
  Podcast,
  ExternalLink
} from "lucide-react";

// Footer link data
const footerLinks1 = [
  { text: "About CSPD", href: "/about" },
  { text: "Upcoming Programs", href: "/upcoming_programs" },
  { text: "Navttc Programs", href: "/Navttc" },
  { text: "President Message", href: "/president_message" },
  { text: "Cancellation Policy", href: "/cancellation_policy" },
  { text: "Contact Us", href: "/contact" },
];

const footerLinks2 = [
  { text: "MAJU University", href: "https://jinnah.edu/" },
  { text: "MAJU FYP", href: "https://fyp.maju.edu.pk/" },
  { text: "Careers at MAJU", href: "https://career.maju.edu.pk/" },
  { text: "MAJU Convocation ", href: "https://convocation.maju.edu.pk/" },
  { text: "Maju IEEE Conference ", href: "https://khihtc.maju.edu.pk/" },
  { text: "Academy", href: "#" },
];

// Social icons mapped to components
const socialLinks = [
  { href: "#", icon: <Facebook size={20} />, label: "Facebook" },
  { href: "#", icon: <Linkedin size={20} />, label: "LinkedIn" },
  { href: "#", icon: <Instagram size={20} />, label: "Instagram" },
  { href: "#", icon: <Youtube size={20} />, label: "YouTube" },
  { href: "#", icon: <Twitter size={20} />, label: "Twitter" },
  { href: "#", icon: <Podcast size={20} />, label: "Podcast" },
];



const Footer = () => {
  return (
    <footer className="majuFooter">
      <div className="container">
        {/* Heading */}
        <div className="mb-4">
          <span className="text-uppercase heading">
            MAJU - Inspiring Future Generations
          </span>
        </div>

        {/* Link Columns */}
        <div className="row footerLinks">
          <div className="col-md-6 col-lg-4">
            <ul>
              {footerLinks1.map((item, idx) => (
                <li key={idx}>
                  <Link to={item.href}>
                    {item.text}
                    <ExternalLink size={12} className="externalIcon" />
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div className="col-md-6 col-lg-4">
            <ul>
              {footerLinks2.map((item, idx) => (
                <li key={idx}>
                  <a href={item.href} target="_blank" >
                    {item.text}
                    <ExternalLink size={12} className="externalIcon" />
                  </a>
                </li>
              ))}
            </ul>
          </div>
        </div>

        {/* Social Media */}
        <div className="row mt-4">
          <div className="col text-center">
            <h5 className="fw-semibold mb-3">Follow Us</h5>
            <div className="socialIcons">
              {socialLinks.map((item, idx) => (
                <a
                  key={idx}
                  href={item.href}
                  className="socialLink"
                  aria-label={item.label}
                >
                  {item.icon}
                </a>
              ))}
            </div>
          </div>
        </div>

        {/* Bottom Links */}
        <div className="row footerBottom mt-4">
    

          {/* Footer Copy */}
          <div className="col-12 footerCopy">
            <span>&copy; MAJU University 2026</span>
            <div className="footerLogo">
              <img src="./maju.png" alt="MAJU Logo" />
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
