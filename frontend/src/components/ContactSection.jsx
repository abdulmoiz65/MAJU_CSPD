import "./ContactSection.css";
import { Phone, Mail } from "lucide-react";

const staff = [
  {
    id: 1,
    name: "Syed Kashir Uddin",
    role: "Assistant Manager – Center for Skills and Professional Development (CSPD)",
    mobile: "0312-2554902",
    email: "kashir.uddin@jinnah.edu",
  },
  {
    id: 2,
    name: "Parkash Lohana",
    role: "Director – Center for Skills and Professional Development (CSPD)",
    mobile: "0300-2307440",
    email: "Parkash.Lohana@jinnah.edu",
  },
];

function ContactSection() {
  return (
    <section className="contact container my-5">

      {/* University Info */}
      <div className="contact-university mb-4">
        <h5>Mohammad Ali Jinnah University (MAJU)</h5>
        <p>Center for Skills and Professional Development (CSPD)</p>
        <p>
          Phone: 021-111-878-787 (Ext: 133 / 137)
        </p>
        <p>
          Address: 22-E, Block-6, P.E.C.H.S, Karachi
        </p>
      </div>

      {/* Staff List */}
      <div className="contact-staff">
        {staff.map((person) => (
          <div key={person.id} className="staff-row">
            <h6>{person.name}</h6>
            <p className="role">{person.role}</p>

            <div className="staff-contact">
              <span>
                <Phone size={14} /> {person.mobile}
              </span>
              <span>
                <Mail size={14} /> {person.email}
              </span>
            </div>
          </div>
        ))}
      </div>
    </section>
  );
}

export default ContactSection;
