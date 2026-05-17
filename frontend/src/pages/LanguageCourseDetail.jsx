import { useParams, useNavigate } from "react-router-dom";
import { useEffect, useState } from "react";
import {
  CalendarDays,
  DollarSign,
  Clock,
  BookOpen,
  Award,
  FileText,
  ArrowLeft,
} from "lucide-react";
import Heading from "../components/Heading";
import languageCourseService from "../services/api/languageCourseService";
import "./ProgramDetail.css";

const LanguageCourseDetail = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [course, setCourse] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || "https://cspd.maju.edu.pk";

  useEffect(() => {
    const fetchCourse = async () => {
      try {
        setLoading(true);
        const response = await languageCourseService.getCourseById(id);
        if (response.success) {
          setCourse(response.data);
        }
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    if (id) {
      fetchCourse();
    }
  }, [id]);

  if (loading) {
    return (
      <div className="program-detail container my-5">
        <button className="btn btn-secondary mb-3" onClick={() => navigate(-1)}>
          <ArrowLeft size={16} /> Back
        </button>
        <div className="text-center py-5">
          <p>Loading course details...</p>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="program-detail container my-5">
        <button className="btn btn-secondary mb-3" onClick={() => navigate(-1)}>
          <ArrowLeft size={16} /> Back
        </button>
        <div className="alert alert-danger">Error: {error}</div>
      </div>
    );
  }

  if (!course) {
    return (
      <div className="program-detail container my-5">
        <button className="btn btn-secondary mb-3" onClick={() => navigate(-1)}>
          <ArrowLeft size={16} /> Back
        </button>
        <div className="alert alert-warning">Course not found.</div>
      </div>
    );
  }

  return (
    <>
      <Heading title="Language Course Details" />
      <div className="program-detail container my-5">
        <div className="row">
          {/* Left Column - Course Details */}
          <div className="col-12">
            {/* Header Section */}
            <div className="detail-header mb-5">
              <div className="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                <h1 className="detail-title mb-0">{course.title}</h1>
                <a
                  href={course.enroll_link || "#"}
                  target="_blank"
                  rel="noopener noreferrer"
                  className={`btn btn-primary btn-lg ${!course.enroll_link ? "disabled" : ""}`}
                  style={{ borderRadius: 0 }}
                >
                  Enroll Now
                </a>
              </div>

              <div className="detail-meta-info">
                {course.start_date && (
                  <div className="meta-item">
                    <CalendarDays size={18} />
                    <div>
                      <label>Date</label>
                      <span>{course.formatted_date || course.start_date}</span>
                    </div>
                  </div>
                )}

                {course.duration && (
                  <div className="meta-item">
                    <Clock size={18} />
                    <div>
                      <label>Duration</label>
                      <span>{course.duration}</span>
                    </div>
                  </div>
                )}

                {course.fees && (
                  <div className="meta-item">
                    <DollarSign size={18} />
                    <div>
                      <label>Fees</label>
                      <span>{course.formatted_fees || `${course.currency} ${course.fees}`}</span>
                    </div>
                  </div>
                )}

                {course.total_hours && (
                  <div className="meta-item">
                    <Clock size={18} />
                    <div>
                      <label>Total Hours</label>
                      <span>{course.total_hours}</span>
                    </div>
                  </div>
                )}
              </div>

              {course.timing && (
                <div className="timing-section">
                  <strong>Timing:</strong> {course.timing}
                </div>
              )}
            </div>

            {/* Main Content */}
            <div className="detail-content">
              {course.overview && (
                <section className="detail-section">
                  <h3>
                    <BookOpen size={20} /> Overview
                  </h3>
                  <p>{course.overview}</p>
                </section>
              )}

              {course.course_outline && (
                <section className="detail-section">
                  <h3>
                    <FileText size={20} /> Course Outline
                  </h3>
                  <div className="text-content">{course.course_outline}</div>
                </section>
              )}

              {course.learning_outcomes && (
                <section className="detail-section">
                  <h3>
                    <Award size={20} /> Learning Outcomes
                  </h3>
                  <div className="text-content">{course.learning_outcomes}</div>
                </section>
              )}

              {course.trainer_profile && (
                <section className="detail-section">
                  <h3>
                    <Award size={20} /> Trainer Profile
                  </h3>
                  <div className="trainer-section d-flex align-items-start gap-4 flex-wrap">
                    {course.trainer_image && (
                      <div className="trainer-image-wrapper">
                        <img
                          src={`${API_BASE_URL}/storage/${course.trainer_image}`}
                          alt="Trainer"
                          className="img-fluid rounded-circle shadow-sm"
                          style={{ width: "150px", height: "150px", objectFit: "cover" }}
                          onError={(e) => {
                            e.target.onerror = null;
                            e.target.style.display = "none";
                          }}
                        />
                      </div>
                    )}
                    <div className="text-content flex-grow-1">{course.trainer_profile}</div>
                  </div>
                </section>
              )}
            </div>


          </div>
        </div>
      </div>
    </>
  );
};

export default LanguageCourseDetail;
