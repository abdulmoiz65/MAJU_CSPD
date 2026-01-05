import React from "react";
import "./PresidentMessage.css";

// Replace with your actual image path
import presidentImg from "../assets/president.jpg";

const PresidentMessage = () => {
  return (
    <section className="president-message container my-5">
      <hr className="title-underline" />

      <div className="row align-items-start mt-4">
        {/* Text Section */}
        <div className="col-lg-7 col-md-12 order-lg-1  order-2">
          <h5 className="message-heading mb-3">
            Message from the President of Mohammad Ali Jinnah University
          </h5>

          <p>
            This University is right in the heart of one of the most vibrant cosmopolitan cities of the world is about both people and place.
          </p>

          <p>
            MAJU (as we are popularly known) strives to liberate students and faculty to explore, create, challenge, and become effective leaders. We empower our students by helping their visions and dreams grow through shared values, diversity, experience, respect, and faith. With special programs and community outreach programs available and encouraged, the curriculum and opportunities at M.A.J University are both exciting and aspiring.
          </p>

          <p>
            The M.A.J University in recent days has initiated a mega transformation phase to make this University a top-ranking University of the region. We’re enhancing the outlook of our faculty who are the top brains being drawn from all over the world to teach, perform, create, and study in a place where everyone belongs. The Industry faculty having minimum 10 years of experience are partnering with us by bringing in the diversity and practical exposure for our students. Technology and business incubators for our graduates and faculty are being created to develop a techno-preneurial eco system.
          </p>

          <p>
            The Academic programs at M.A.J University are designed from Bachelors to PhD in disciplines of Management Sciences, Accounting, Economics & Finance, Computing Sciences, Electrical Engineering, Information Systems, Media Sciences and very soon other disciplines too. With an FM Radio station and partnerships with other leading Universities we are initiating blended programs in diverse areas at M.A.J University. With flexible course plans one can craft his/her own Degree plans and majors.
          </p>

          <p>
            As the President of M.A.J University, I believe in giving you a dream and environment to accomplish your academic and professional goals: may you be a student, a faculty, a non-teaching staff member, an industry collaborator, an alumnus, a parent or just a passerby. Once you step-in, you are part of our MAJU fraternity.  We are also an important part of one of the largest educational conglomerate of Asia comprising of 3 Universities, a College Network of over 800 colleges and a network of over 3500 schools.
          </p>

          <p>
            I hope you find Mohammad Ali Jinnah University as exhilarating and enriching as I do.
          </p>
        </div>

        {/* Image Section */}
        <div className="col-lg-5 col-md-12 mb-5 text-center mt-4 mt-lg-0 order-lg-2 order-1">
          <div className="image-wrapper mx-auto">
            <img
              src={presidentImg}
              alt="President of Mohammad Ali Jinnah University"
              className="img-fluid president-img"
            />
          </div>
        </div>
      </div>
    </section>
  );
};

export default PresidentMessage;
