import maju from "../assets/maju.jpg"
import cspd from "../assets/cspd.avif"
import { useNavigate } from "react-router-dom";
import "./AboutCombined.css";

const AboutCombined = () => {
  const navigate = useNavigate();

  return (
    <div className="about-combined-wrapper">
      {/* About CSPD - Content Left, Image Right */}
      <section className="about-section-cspd">
        <div className="about-content">
          <h2>About CSPD</h2>
          <p>
            The Centre for Skills & Professional Development (CSPD) at Mohammad Ali
            Jinnah University offers inclusive, ethical, and high-quality training
            programs to equip different learners with skills, technology, and a
            forward-thinking mindset.
          </p>
          <button className="btn-view-more" onClick={() => navigate("/about")}>
            View More
          </button>
        </div>
        <div className="about-image">
          <img src={cspd} alt="CSPD" />
        </div>
      </section>

      {/* About MAJU - Image Left, Content Right */}
      <section className="about-section-maju">
        
        <div className="about-content">
          <h2>About MAJU</h2>
          <p>
            Mohammad Ali Jinnah University is a prestigious research-oriented
            academic institution that prepares its students to make a mark on
            the world. Located in the heart of Karachi, the University instils
            a lifelong intellectual curiosity in its students.
          </p>
          <button className="btn-view-more" onClick={() => navigate("/about_maju")}>
            View More
          </button>
        </div>
        <div className="about-image">
          <img src={maju} alt="MAJU" />
        </div>
      </section>
    </div>
  );
};

export default AboutCombined;
