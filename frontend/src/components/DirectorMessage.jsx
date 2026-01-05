import React from "react";
import "./PresidentMessage.css"; // Reuse existing styles

// Replace with your actual image path when available
import directorImg from "../assets/directorCSPD.jpg";

const DirectorMessage = () => {
    return (
        <section className="president-message container my-5">
            <hr className="title-underline" />

            <div className="row align-items-start mt-4">
                {/* Text Section */}
                <div className="col-lg-7 col-md-12 order-lg-1  order-2">
                    <h5 className="message-heading mb-3">
                        Message from the Director CSPD
                    </h5>

                    <p>
                        Welcome to the Centre for Skills & Professional Development (CSPD) at Mohammad Ali Jinnah University.
                    </p>

                    <p>
                        Our mission is to equip learners with industry-relevant skills, a forward-thinking mindset, and professional excellence. We offer inclusive and high-quality training programs designed to help you overcome professional challenges and contribute to a knowledge-driven society.
                    </p>

                    <p>
                        Whether you are starting your career or looking to advance to the next level, CSPD provides the platform to foster your growth and success. We look forward to being part of your professional journey.
                    </p>
                </div>

                {/* Image Section */}
                <div className="col-lg-5 col-md-12 mb-5 text-center mt-4 mt-lg-0 order-lg-2 order-1">
                    <div className="image-wrapper mx-auto">
                        <img
                            src={directorImg}
                            alt="Director CSPD"
                            className="img-fluid president-img"
                        />
                    </div>
                </div>
            </div>
        </section>
    );
};

export default DirectorMessage;
