import { useEffect, useMemo, useState } from "react";
import "./Hero.css";

const slides = [
  {
    image: "https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80",
    tag: "Product Launch",
    title: "Experience design for next-gen SaaS dashboards",
  },
  {
    image: "https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?auto=format&fit=crop&w=1200&q=80",
    tag: "Brand Refresh",
    title: "Identity systems built for modern, ambitious teams",
  },
  {
    image: "https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80",
    tag: "Campaign",
    title: "Integrated storytelling that sparks conversion",
  },
];
function Hero() {
  const [activeSlide, setActiveSlide] = useState(0);
  const slideCount = slides.length;
  const progress = useMemo(() => ((activeSlide + 1) / slideCount) * 100, [activeSlide, slideCount]);

  useEffect(() => {
    const timer = setInterval(() => {
      setActiveSlide(current => (current + 1) % slideCount);
    }, 5000);

    return () => clearInterval(timer);
  }, [slideCount]);

  const goToSlide = direction => {
    setActiveSlide(current => (current + direction + slideCount) % slideCount);
  };

  return (
    <section className="hero" id="home" aria-label="hero">
      <div className="container hero__grid">
        <div className="hero__content">
          <p className="hero__eyebrow">Design & Strategy Studio</p>
          <h1 className="hero__title">
            Centre for Skills & Professional Development (CSPD)
          </h1>
          <p className="hero__text">
            Fostering industry-relevant skills, an entrepreneurial mindset, and professional excellence preparing learners for a knowledge-driven society.
          </p>

          <div className="hero__actions">
            <a className="btn btn-primary" href="#contact">
              Start a project
            </a>
            <a className="btn btn-ghost" href="#work">
              See our work →
            </a>
          </div>

       
        </div>

        <div className="hero__media">
          <div className="hero__slider">
            {slides.map((slide, index) => (
              <div
                key={slide.title}
                className={`hero__slide ${index === activeSlide ? "is-active" : ""}`}
                style={{ backgroundImage: `url(${slide.image})` }}
              >
                <div className="hero__slide-overlay" />
                <div className="hero__slide-content">
                  <p>{slide.tag}</p>
                  <h3>{slide.title}</h3>
                </div>
              </div>
            ))}
            <div className="hero__slider-progress">
              <span style={{ width: `${progress}%` }} />
            </div>

            <div className="hero__slider-controls">
              <button type="button" onClick={() => goToSlide(-1)} aria-label="Previous slide">
                ←
              </button>
              <button type="button" onClick={() => goToSlide(1)} aria-label="Next slide">
                →
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}

export default Hero;
