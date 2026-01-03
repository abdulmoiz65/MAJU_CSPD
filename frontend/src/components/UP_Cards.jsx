import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import "./UP_Cards.css";
import { CalendarDays, MapPin, Download } from "lucide-react";
import upcomingProgramService from "../services/api/upcomingProgramService";

// Local images (NOT from DB)
import prog1 from "../assets/ProgramCards/program_card.jpg";
import prog2 from "../assets/ProgramCards/program_card2.jpg";
import prog3 from "../assets/ProgramCards/program_card3.jpg";
import prog4 from "../assets/ProgramCards/program_card4.jpg";
import prog5 from "../assets/ProgramCards/program_card5.jpg";
import prog6 from "../assets/ProgramCards/program_card6.jpg";

// Static images array - assigned to programs in order
const staticImages = [prog1, prog2, prog3, prog4, prog5, prog6];

function UpcomingPrograms() {
  const [programs, setPrograms] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const navigate = useNavigate();

  const API_BASE_URL = import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000';

  // Fetch latest 6 programs on mount
  useEffect(() => {
    const fetchPrograms = async () => {
      try {
        setLoading(true);
        setError(null);
        const response = await upcomingProgramService.getLatestPrograms(6);

        if (response.success && response.data) {
          setPrograms(response.data);
        }
      } catch (err) {
        console.error('Failed to fetch programs:', err);
        setError('Failed to load programs');
        setPrograms([]);
      } finally {
        setLoading(false);
      }
    };

    fetchPrograms();
  }, []);

  // Helper function to format date if needed
  const formatDate = (dateString) => {
    if (!dateString) return 'TBA';
    try {
      const date = new Date(dateString);
      return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
    } catch (e) {
      return dateString;
    }
  };

  return (
    <section className="upcoming-programs container my-5">
      <h2 className="section-title text-center mb-5">
        <span className="underline-word">Upcom</span>ing Programs
      </h2>

      {/* Loading State */}
      {loading && (
        <div className="text-center py-5">
          <p>Loading programs...</p>
        </div>
      )}

      {/* Error State */}
      {error && (
        <div className="alert alert-danger text-center">
          {error}
        </div>
      )}

      {/* Programs Grid */}
      {!loading && !error && (
        <div className="row g-4">
          {programs.map((program, index) => (
            <div key={program.id} className="col-lg-4 col-md-6">
              <div className="program-card">
                <img
                  src={staticImages[index] || prog1}
                  alt={program.title}
                  className="program-img"
                />

                <div className="program-body">
                  <h5 className="program-title">
                    {program.title}
                  </h5>

                  <p className="program-meta">
                    <CalendarDays size={18} />
                    <span>{program.formatted_date || formatDate(program.start_date)}</span>
                  </p>

                  <p className="program-meta">
                    <MapPin size={18} />
                    <span>{program.location || 'TBA'}</span>
                  </p>

                  <div className="program-actions">
                    <button
                      className="btn btn-details"
                      onClick={() => navigate(`/program-detail/${program.id}`)}
                    >
                      Workshop Details
                    </button>

                    <a
                      href={program.enroll_link || '#'}
                      className={`btn btn-apply ${!program.enroll_link ? 'disabled' : ''}`}
                      target={program.enroll_link ? "_blank" : "_self"}
                      rel={program.enroll_link ? "noopener noreferrer" : ""}
                    >
                      Apply Now
                    </a>

                    {program.brochure && (
                      <a
                        href={`${API_BASE_URL}/storage/${program.brochure}`}
                        className="btn btn-brochure"
                        target="_blank"
                        rel="noopener noreferrer"
                        download
                      >
                        <Download size={14} strokeWidth={1.8} />
                        Download Brochure
                      </a>
                    )}
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}

      <div className="view-all-wrapper text-center mt-5">
        <a href="/upcoming_programs" className="button">
          <span>View All Programs</span>
        </a>
      </div>
    </section>
  );
}

export default UpcomingPrograms;
