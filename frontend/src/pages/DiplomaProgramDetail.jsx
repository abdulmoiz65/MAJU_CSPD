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
import diplomaProgramService from "../services/api/diplomaProgramService";
import "./ProgramDetail.css";

const DiplomaProgramDetail = () => {
  const { id } = useParams();
  const navigate = useNavigate();
  const [program, setProgram] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || "https://cspd.maju.edu.pk";

  useEffect(() => {
    const fetchProgram = async () => {
      try {
        setLoading(true);
        const response = await diplomaProgramService.getProgramById(id);
        if (response.success) {
          setProgram(response.data);
        }
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
        <button className="btn btn-secondary mb-3" onClick={() => navigate(-1)}>
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
        <button className="btn btn-secondary mb-3" onClick={() => navigate(-1)}>
          <ArrowLeft size={16} /> Back
        </button>
        <div className="alert alert-danger">Error: {error}</div>
      </div>
    );
  }

  if (!program) {
    return (
      <div className="program-detail container my-5">
        <button className="btn btn-secondary mb-3" onClick={() => navigate(-1)}>
          <ArrowLeft size={16} /> Back
        </button>
        <div className="alert alert-warning">Program not found.</div>
      </div>
    );
  }

  return (
    <>
      <Heading title="Diploma Program Details" />
      <div className="program-detail container my-5">
        <div className="row">
          {/* Left Column - Program Details */}
          <div className="col-md-8">
            {/* Header Section */}
            <div className="detail-header mb-5">
              <div className="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                <h1 className="detail-title mb-0">{program.title}</h1>
                <a
                  href={program.enroll_link || "#"}
                  target="_blank"
                  rel="noopener noreferrer"
                  className={`btn btn-primary btn-lg ${!program.enroll_link ? "disabled" : ""}`}
                  style={{ borderRadius: 0 }}
                >
                  Enroll Now
                </a>
              </div>

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
                          style={{ width: "150px", height: "150px", objectFit: "cover" }}
                          onError={(e) => {
                            e.target.onerror = null;
                            e.target.style.display = "none";
                          }}
                        />
                      </div>
                    )}
                    <div className="text-content flex-grow-1">{program.trainer_profile}</div>
                  </div>
                </section>
              )}
            </div>


          </div>

          {/* Right Column - Timeline */}
          <div className="col-md-4">
            <Timeline timeline={program.timeline} />
          </div>
        </div>
      </div>
    </>
  );
};

export default DiplomaProgramDetail;
