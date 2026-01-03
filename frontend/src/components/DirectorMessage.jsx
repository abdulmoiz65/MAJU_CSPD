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
                        Welcome to the Center for Executive Education (CEE) at Mohammad Ali Jinnah University!
                    </p>

                    <p>
                        Since 2003, the Center for Executive Education (CEE)
                        has been working to transform managers into leaders in the public,
                        family business and the corporate sectors of Pakistan. We do this
                        through offering a range of educational programs covering
                        governance, leadership, strategy and other specialized subjects.
                    </p>

                    <p>
                        Our programs prepare participants to reach new levels of success in
                        their careers while helping their organizations achieve increased
                        value, productivity, impact and employee satisfaction. Along with
                        expanding their knowledge and enhancing their skills in key
                        leadership areas, program participants learn the importance of
                        adaptability and how to manage ongoing uncertainty while remaining
                        focused on their organization&apos;s goals and values.
                    </p>

                    <p>
                        Participants also explore how to inspire and implement innovation
                        in their organization, and form successful strategic alliances with
                        external partners with bespoke and open programs as well as
                        post-graduate and diploma programs.
                    </p>

                    <p>
                        A committed faculty, drawn from academia and industry, provides
                        practical management knowledge and experience. The faculty consists
                        of outstanding experts in their fields who actively engage course
                        participants in an intense and rewarding learning process.
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
