import React, { useEffect, useRef, useState } from "react";
import "./Slider.css";

// Import images
import slide1 from "../assets/slider/1.JPG";
import slide2 from "../assets/slider/2.jpeg";
import slide3 from "../assets/slider/3.JPG";
import slide4 from "../assets/slider/4.jpeg";
import slide5 from "../assets/slider/5.jpeg";
import slide6 from "../assets/slider/7.JPG";
import slide7 from "../assets/slider/8.jpeg";

const slidesData = [
  {
    id: 0,
    image: slide1,
    title: "Welcome to MAJU CSPD"
  },
  {
    id: 1,
    image: slide2,
    title: "Excellence in Education"
  },
  {
    id: 2,
    image: slide3,
    title: "Innovative Learning"
  },
  {
    id: 3,
    image: slide4,
    title: "Global Recognition"
  },
  {
    id: 4,
    image: slide5,
    title: "Student Success"
  },
  {
    id: 5,
    image: slide6,
    title: "Research & Development"
  },
  {
    id: 6,
    image: slide7,
    title: "Community Engagement"
  }
];

function Slider() {
  const [currentSlide, setCurrentSlide] = useState(0);
  const [autoPlay, setAutoPlay] = useState(true);
  const autoPlayRef = useRef(null);
  const AUTO_PLAY_DELAY = 4000;

  const playSVG = `<svg viewBox="0 0 24 24"><polygon points="8,5 19,12 8,19" fill="#222"/></svg>`;
  const pauseSVG = `<svg viewBox="0 0 24 24"><rect x="6" y="5" width="4" height="14" fill="#222"/><rect x="14" y="5" width="4" height="14" fill="#222"/></svg>`;

  // Show slide
  const showSlide = (index) => {
    if (index < 0) index = slidesData.length - 1;
    if (index >= slidesData.length) index = 0;
    setCurrentSlide(index);
  };

  const nextSlide = () => showSlide(currentSlide + 1);
  const prevSlide = () => showSlide(currentSlide - 1);

  // Auto play
  const playAutoPlay = () => {
    setAutoPlay(true);
    clearInterval(autoPlayRef.current);

    autoPlayRef.current = setInterval(() => {
      setCurrentSlide((prev) => (prev + 1) % slidesData.length);
    }, AUTO_PLAY_DELAY);
  };

  const pauseAutoPlay = () => {
    setAutoPlay(false);
    clearInterval(autoPlayRef.current);
  };

  useEffect(() => {
    playAutoPlay();
    return () => clearInterval(autoPlayRef.current);
  }, []);

  // Keyboard navigation
  useEffect(() => {
    const handler = (e) => {
      if (e.key === "ArrowLeft") prevSlide();
      if (e.key === "ArrowRight") nextSlide();
    };
    document.addEventListener("keydown", handler);
    return () => document.removeEventListener("keydown", handler);
  });

  return (
    <div className="hero-slider" id="home">
      <div
        className="slides-wrapper"
        style={{ transform: `translateX(-${currentSlide * 100}vw)` }}
      >
        {slidesData.map((slide) => (
          <div
            key={slide.id}
            className="slide"
            style={{ backgroundImage: `url(${slide.image})` }}
          >
            <div className="slide-content">
              <h1>{slide.title}</h1>
            </div>
          </div>
        ))}
      </div>

      {/* Arrows */}
      <button className="arrow left" onClick={prevSlide}>
        <svg viewBox="0 0 24 24">
          <polyline points="15 6 9 12 15 18" />
        </svg>
      </button>

      <button className="arrow right" onClick={nextSlide}>
        <svg viewBox="0 0 24 24">
          <polyline points="9 6 15 12 9 18" />
        </svg>
      </button>

      {/* Dots */}
      <div className="slider-dots">
        {slidesData.map((_, i) => (
          <div
            key={i}
            className={`dot ${currentSlide === i ? "active" : ""}`}
            onClick={() => {
              showSlide(i);
              pauseAutoPlay();
            }}
          >
            <span
              className="dot-icon"
              onClick={(e) => {
                e.stopPropagation();
                autoPlay ? pauseAutoPlay() : playAutoPlay();
              }}
              dangerouslySetInnerHTML={{
                __html:
                  currentSlide === i
                    ? autoPlay
                      ? pauseSVG
                      : playSVG
                    : "",
              }}
            ></span>
          </div>
        ))}
      </div>

      {/* Scroll Down */}
      <div className="scroll-down">
        <span>Scroll down</span>
        <svg viewBox="0 0 24 24">
          <polyline points="6 10 12 16 18 10" />
        </svg>
      </div>
    </div>
  );
}
export default Slider;