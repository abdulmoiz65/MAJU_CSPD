import { useParams, useNavigate } from "react-router-dom";
import { useEffect, useState } from "react";
import {
  CalendarDays,
  MapPin,
  DollarSign,
  Clock,
  BookOpen,
  Users,
  Award,
  FileText,
  ArrowLeft,
} from "lucide-react";
import Heading from "../components/Heading";
import "./ProgramDetail.css";

const ProgramDetail = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [program, setProgram] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // API base URL for constructing full URLs to backend resources
  const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000';

  useEffect(() => {
    const fetchProgram = async () => {
      try {
        setLoading(true);
        const response = await fetch(
          `http://localhost:8000/api/upcoming-programs/${id}`
        );

        if (!response.ok) {
          throw new Error("Failed to fetch program details");
        }

        const data = await response.json();
        setProgram(data.data);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    if (id) {
      fetchProgram();
    }
  }, [id]);

  if (loading) {
    return (
      <div className="program-detail container my-5">
        <button
          className="btn btn-secondary mb-3"
          onClick={() => navigate(-1)}
        >
          <ArrowLeft size={16} /> Back
        </button>
        <div className="text-center py-5">
          <p>Loading program details...</p>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="program-detail container my-5">
        <button
          className="btn btn-secondary mb-3"
          onClick={() => navigate(-1)}
        >
          <ArrowLeft size={16} /> Back
        </button>
        <div className="alert alert-danger">Error: {error}</div>
      </div>
    );
  }

  if (!program) {
    return (
      <div className="program-detail container my-5">
        <button
          className="btn btn-secondary mb-3"
          onClick={() => navigate(-1)}
        >
          <ArrowLeft size={16} /> Back
        </button>
        <div className="alert alert-warning">Program not found.</div>
      </div>
    );
  }

  return (
    <>
      <Heading title="Program Details" />
      <div className="program-detail container my-5">


        {/* Header Section */}
        <div className="detail-header mb-5">
          <h1 className="detail-title">{program.title}</h1>

          <div className="detail-meta-info">
            {program.start_date && (
              <div className="meta-item">
                <CalendarDays size={18} />
                <div>
                  <label>Date</label>
                  <span>{program.formatted_date || program.start_date}</span>
                </div>
              </div>
            )}

            {program.duration && (
              <div className="meta-item">
                <Clock size={18} />
                <div>
                  <label>Duration</label>
                  <span>{program.duration}</span>
                </div>
              </div>
            )}

            {program.fees && (
              <div className="meta-item">
                <DollarSign size={18} />
                <div>
                  <label>Fees</label>
                  <span>{program.formatted_fees || `${program.currency} ${program.fees}`}</span>
                </div>
              </div>
            )}

            {program.total_hours && (
              <div className="meta-item">
                <Clock size={18} />
                <div>
                  <label>Total Hours</label>
                  <span>{program.total_hours}</span>
                </div>
              </div>
            )}
          </div>

          {program.timing && (
            <div className="timing-section">
              <strong>Timing:</strong> {program.timing}
            </div>
          )}
        </div>

        {/* Main Content */}
        <div className="detail-content">
          {program.overview && (
            <section className="detail-section">
              <h3>
                <BookOpen size={20} /> Overview
              </h3>
              <p>{program.overview}</p>
            </section>
          )}

          {program.course_outline && (
            <section className="detail-section">
              <h3>
                <FileText size={20} /> Course Outline
              </h3>
              <div className="text-content">{program.course_outline}</div>
            </section>
          )}

          {program.learning_outcomes && (
            <section className="detail-section">
              <h3>
                <Award size={20} /> Learning Outcomes
              </h3>
              <div className="text-content">{program.learning_outcomes}</div>
            </section>
          )}

          {program.methodology && (
            <section className="detail-section">
              <h3>
                <BookOpen size={20} /> Methodology
              </h3>
              <div className="text-content">{program.methodology}</div>
            </section>
          )}

          {program.activities && (
            <section className="detail-section">
              <h3>
                <Users size={20} /> Activities
              </h3>
              <div className="text-content">{program.activities}</div>
            </section>
          )}

          {program.trainer_profile && (
            <section className="detail-section">
              <h3>
                <Award size={20} /> Trainer Profile
              </h3>
              <div className="trainer-section d-flex align-items-start gap-4 flex-wrap">
                {program.trainer_image && (
                  <div className="trainer-image-wrapper">
                    <img
                      src={`${API_BASE_URL}/storage/${program.trainer_image}`}
                      alt="Trainer"
                      className="img-fluid rounded-circle shadow-sm"
                      style={{ width: '150px', height: '150px', objectFit: 'cover' }}
                      onError={(e) => {
                        e.target.onerror = null;
                        e.target.style.display = 'none';
                      }}
                    />
                  </div>
                )}
                <div className="text-content flex-grow-1">{program.trainer_profile}</div>
              </div>
            </section>
          )}

          {program.who_should_attend && (
            <section className="detail-section">
              <h3>
                <Users size={20} /> Who Should Attend
              </h3>
              <div className="text-content">{program.who_should_attend}</div>
            </section>
          )}

          {program.publications && (
            <section className="detail-section">
              <h3>
                <FileText size={20} /> Publications
              </h3>
              <div className="text-content">{program.publications}</div>
            </section>
          )}

          {program.discount_info && (
            <section className="detail-section discount-section">
              <h3>Discount Information</h3>
              <div className="text-content">{program.discount_info}</div>
            </section>
          )}

          {program.brochure && (
            <section className="detail-section">
              <h3>
                <FileText size={20} /> Brochure
              </h3>
              <a
                href={`${API_BASE_URL}/storage/${program.brochure}`}
                target="_blank"
                rel="noopener noreferrer"
                className="btn btn-primary"
              >
                Download Brochure
              </a>
            </section>
          )}
        </div>

        {/* CTA Section */}
        <div className="detail-cta mt-5 pb-4">
          <a
            href={program.enroll_link || '#'}
            target="_blank"
            rel="noopener noreferrer"
            className={`btn btn-warning btn-lg me-2 ${!program.enroll_link ? 'disabled' : ''}`}
          >
            Enroll Now
          </a>
        </div>
      </div>
    </>
  );
};

export default ProgramDetail;
