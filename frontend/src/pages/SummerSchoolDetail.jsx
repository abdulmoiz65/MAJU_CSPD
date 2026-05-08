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
import Timeline from "../components/Timeline";
import summerSchoolService from "../services/api/summerSchoolService";
import "./ProgramDetail.css";

const SummerSchoolDetail = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [school, setSchool] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || "https://cspd.maju.edu.pk";

  useEffect(() => {
    const fetchSchool = async () => {
      try {
        setLoading(true);
        const response = await summerSchoolService.getSchoolById(id);
        if (response.success) {
          setSchool(response.data);
        }
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };

    if (id) {
      fetchSchool();
    }
  }, [id]);

  if (loading) {
    return (
      <div className="program-detail container my-5">
        <button className="btn btn-secondary mb-3" onClick={() => navigate(-1)}>
          <ArrowLeft size={16} /> Back
        </button>
        <div className="text-center py-5">
          <p>Loading summer school details...</p>
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

  if (!school) {
    return (
      <div className="program-detail container my-5">
        <button className="btn btn-secondary mb-3" onClick={() => navigate(-1)}>
          <ArrowLeft size={16} /> Back
        </button>
        <div className="alert alert-warning">Summer school not found.</div>
      </div>
    );
  }

  return (
    <>
      <Heading title="Summer School Details" />
      <div className="program-detail container my-5">
        <div className="row">
          {/* Left Column - Details */}
          <div className="col-md-8">
            <div className="detail-header mb-5">
              <div className="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                <h1 className="detail-title mb-0">{school.title}</h1>
                <a
                  href={school.enroll_link || "#"}
                  target="_blank"
                  rel="noopener noreferrer"
                  className={`btn btn-primary btn-lg ${!school.enroll_link ? "disabled" : ""}`}
                  style={{ borderRadius: 0 }}
                >
                  Enroll Now
                </a>
              </div>

              <div className="detail-meta-info">
                {school.start_date && (
                  <div className="meta-item">
                    <CalendarDays size={18} />
                    <div>
                      <label>Date</label>
                      <span>{school.formatted_date || school.start_date}</span>
                    </div>
                  </div>
                )}

                {school.duration && (
                  <div className="meta-item">
                    <Clock size={18} />
                    <div>
                      <label>Duration</label>
                      <span>{school.duration}</span>
                    </div>
                  </div>
                )}

                {school.fees && (
                  <div className="meta-item">
                    <DollarSign size={18} />
                    <div>
                      <label>Fees</label>
                      <span>{school.formatted_fees || `PKR ${school.fees}`}</span>
                    </div>
                  </div>
                )}

                {school.total_hours && (
                  <div className="meta-item">
                    <Clock size={18} />
                    <div>
                      <label>Total Hours</label>
                      <span>{school.total_hours}</span>
                    </div>
                  </div>
                )}
              </div>

              {school.timing && (
                <div className="timing-section">
                  <strong>Timing:</strong> {school.timing}
                </div>
              )}
            </div>

            {/* Main Content */}
            <div className="detail-content">
              {school.overview && (
                <section className="detail-section">
                  <h3>
                    <BookOpen size={20} /> Overview
                  </h3>
                  <p>{school.overview}</p>
                </section>
              )}

              {school.course_outline && (
                <section className="detail-section">
                  <h3>
                    <FileText size={20} /> Course Outline
                  </h3>
                  <div className="text-content">{school.course_outline}</div>
                </section>
              )}

              {school.learning_outcomes && (
                <section className="detail-section">
                  <h3>
                    <Award size={20} /> Learning Outcomes
                  </h3>
                  <div className="text-content">{school.learning_outcomes}</div>
                </section>
              )}

              {school.trainer_profile && (
                <section className="detail-section">
                  <h3>
                    <Award size={20} /> Trainer Profile
                  </h3>
                  <div className="trainer-section d-flex align-items-start gap-4 flex-wrap">
                    {school.trainer_image && (
                      <div className="trainer-image-wrapper">
                        <img
                          src={`${API_BASE_URL}/storage/${school.trainer_image}`}
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
                    <div className="text-content flex-grow-1">{school.trainer_profile}</div>
                  </div>
                </section>
              )}
            </div>
          </div>

          {/* Right Column - Timeline */}
          <div className="col-md-4">
            <Timeline timeline={school.timeline} />
          </div>
        </div>
      </div>
    </>
  );
};

export default SummerSchoolDetail;
