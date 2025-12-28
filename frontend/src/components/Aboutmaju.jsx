import "./AboutSection.css";

function Aboutmaju() {
  return (
    <section className="about-section container my-5">
      <div className="about-card p-4 p-md-5">
        {/* Main Tagline */}
        <div className="mb-5">
          <h2 className="section-title">Live, Learn and Be Inspired</h2>
          <div className="title-line"></div>
        </div>

        {/* Introduction */}
        <div className="mb-5 content-block">
          <p className="section-text">
            Mohammad Ali Jinnah University is a prestigious research-oriented
            academic institution that prepares its students to make a mark on
            the world. Located in the heart of Karachi, the University instils
            a lifelong intellectual curiosity in its students. World-class
            faculty, well equipped labs and emphasis on research ensure students
            evolve into successful global citizens.
          </p>
        </div>

        {/* VISION */}
        <div className="mb-5 content-block">
          <h3 className="sub-title">Our Vision</h3>
          <p className="section-text">
            To be recognized as a leading institute nationally and
            internationally for producing competent professionals who are
            instrumental in development of a prosperous society.
          </p>
        </div>

        {/* MISSION */}
        <div className="content-block">
          <h3 className="sub-title">Our Mission</h3>
          <p className="section-text">
            Mohammad Ali Jinnah University, through the pursuit of excellence in
            an ethical environment, is committed to provide necessary
            intellectual and technological tools to a diverse student population
            in order to meet the challenges of the future.
          </p>
        </div>
      </div>
    </section>
  );
};

export default Aboutmaju;