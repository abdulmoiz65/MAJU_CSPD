import React from "react";
import "./AboutSection.css";

const AboutSection = () => {
  return (
    <section className="about-section container my-5">
      <div className="about-card p-4 p-md-5">


        {/* VISION */}
        <div className="mb-5 content-block">
          <h3 className="sub-title">CSPD Vision</h3>
          <p className="section-text">
            To be recognized as one of the leading centers for fostering
            industry-relevant skills, entrepreneurial mindset, and professional
            excellence, allowing individuals to contribute to a knowledge-driven
            society.
          </p>
        </div>

        {/* MISSION */}
        <div className="content-block">
          <h3 className="sub-title">CSPD Mission</h3>
          <p className="section-text">
            The Centre for Skills & Professional Development (CSPD) at Mohammad Ali
            Jinnah University offers inclusive, ethical, and high-quality training
            programs to equip different learners with skills, technology, and a
            forward-thinking mindset. This equips learners to overcome obstacles,
            succeed professionally, and contribute to a prosperous and inventive
            community.
          </p>
        </div>
      </div>
    </section>
  );
};

export default AboutSection;
