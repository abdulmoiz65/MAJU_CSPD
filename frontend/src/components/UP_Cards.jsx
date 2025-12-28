import "./UP_Cards.css";
import { CalendarDays, MapPin, Download } from "lucide-react";

// Local images (NOT from DB)
import prog1 from "../assets/ProgramCards/program_card.jpg";
import prog2 from "../assets/ProgramCards/program_card2.jpg";
import prog3 from "../assets/ProgramCards/program_card3.jpg";
import prog4 from "../assets/ProgramCards/program_card4.jpg";
import prog5 from "../assets/ProgramCards/program_card5.jpg";
import prog6 from "../assets/ProgramCards/program_card6.jpg";

// image resolver (key from backend → local image)
const imageMap = {
  prog1,
  prog2,
  prog3,
  prog4,
  prog5,
  prog6,
};

function UpcomingPrograms() {
  // 🔹 This will later come from backend API
  const programs = [
    {
      id: 1,
      title: "Directors' Training Program",
      date: "08 to 12 December, 2025",
      location: "IBA Islamabad, NIBAF",
      applyLink: "https://navttc.gov.pk/apply/1",
      brochureLink: "/brochures/directors.pdf",
      imageKey: "prog1",
    },
    {
      id: 2,
      title: "Directors' Training Program (SOEs)",
      date: "15 to 17 December, 2025",
      location: "IBA Islamabad, NIBAF",
      applyLink: "https://navttc.gov.pk/apply/2",
      brochureLink: "/brochures/soe.pdf",
      imageKey: "prog2",
    },
    {
      id: 3,
      title: "Managerial Communication Strategies",
      date: "16 & 17 December, 2025",
      location: "IBA Islamabad, NIBAF",
      applyLink: "https://navttc.gov.pk/apply/3",
      brochureLink: "/brochures/communication.pdf",
      imageKey: "prog3",
    },
     {
      id: 4,
      title: "Directors' Training Program",
      date: "08 to 12 December, 2025",
      location: "IBA Islamabad, NIBAF",
      applyLink: "https://navttc.gov.pk/apply/1",
      brochureLink: "/brochures/directors.pdf",
      imageKey: "prog4",
    },
     {
      id: 5,
      title: "Directors' Training Program",
      date: "08 to 12 December, 2025",
      location: "IBA Islamabad, NIBAF",
      applyLink: "https://navttc.gov.pk/apply/1",
      brochureLink: "/brochures/directors.pdf",
      imageKey: "prog5",
    },
     {
      id: 6,
      title: "Directors' Training Program",
      date: "08 to 12 December, 2025",
      location: "IBA Islamabad, NIBAF",
      applyLink: "https://navttc.gov.pk/apply/1",
      brochureLink: "/brochures/directors.pdf",
      imageKey: "prog6",
    },
  ];

  return (
    <section className="upcoming-programs container my-5">
      <h2 className="section-title text-center mb-5">
        <span className="underline-word">Upcom</span>ing Programs
      </h2>

      <div className="row g-4">
        {programs.map((program) => (
          <div key={program.id} className="col-lg-4 col-md-6">
            <div className="program-card">
              <img
                src={imageMap[program.imageKey] || prog1}
                alt={program.title}
                className="program-img"
              />

              <div className="program-body">
                <h5 className="program-title">
                  {program.title}
                </h5>

                <p className="program-meta">
                  <CalendarDays size={18} />
                  <span>{program.date}</span>
                </p>

                <p className="program-meta">
                  <MapPin size={18} />
                  <span>{program.location}</span>
                </p>

                <div className="program-actions">
                  <button className="btn btn-details">
                    Workshop Details
                  </button>

                  <a
                    href={program.applyLink}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="btn btn-apply"
                  >
                    Apply Now
                  </a>

                  <a
                    href={program.brochureLink}
                    className="btn btn-brochure"
                    download
                  >
                    <Download size={14} strokeWidth={1.8} />
                    Download Brochure
                  </a>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>

      <div className="view-all-wrapper text-center mt-5">
        <a href="/upcoming_programs" className="button">
          <span>View All Programs</span>
        </a>
      </div>
    </section>
  );
}

export default UpcomingPrograms;
