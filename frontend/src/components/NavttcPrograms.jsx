import { useEffect, useState } from "react";
import { Search } from "lucide-react";
import "./NavttcProgram.css";

const NavttcPrograms = () => {
  const trades = [
    { id: 1,
      title: "Amazon Virtual Assistant",
      qualification: "Intermediate",
      applyLink:"https://nsis.navttc.gov.pk/"  },
    { id: 2, title: "Digital Marketing & Search Engine Optimization (SEO)", qualification: "Intermediate" , applyLink:"https://nsis.navttc.gov.pk/" },
    { id: 3, title: "Graphic Design and Video Editing", qualification: "Intermediate" , applyLink:"https://nsis.navttc.gov.pk/" },
    {
      id: 4,
      title: "Microsoft Power BI",
      qualification:
      "Bachelor in Commerce, Economics, Statistics, Banking, Finance, ACCA, CS, IT, Maths, ICMA inter, CA inter, PIPFA, BBA, AI/Fintech, Banking & Finance, Accounting & Finance, or Business Analytics", applyLink:"https://nsis.navttc.gov.pk/"
    },
    {
      id: 5,
      title: "Cyber Security (CEH)",
      qualification:
      "Bachelor in IT, CS, Maths, Statistics, Economics, Physics or Engineering (or 5th semester enrolled)", 
      applyLink:"https://nsis.navttc.gov.pk/"
    },
    { id: 6, title: "English Language (IELTS/PTE B1–B2 CEFR)", qualification: "Matric OR 3 Months Vocational Certificate", applyLink:"https://nsis.navttc.gov.pk/" },
    { id: 7, title: "German Language A1", qualification: "Matric OR 3 Months Vocational Certificate" , applyLink:"https://nsis.navttc.gov.pk/" },
    { id: 8, title: "Professional Photography, Documentary Ad Making", qualification: "Intermediate" , applyLink:"https://nsis.navttc.gov.pk/" },
  ];

  const [searchText, setSearchText] = useState("");
  const [filteredTrades, setFilteredTrades] = useState(trades);

  //  debounce method
  useEffect(() => {
    const timer = setTimeout(() => {
      const query = searchText.toLowerCase().trim();

      if (!query) {
        setFilteredTrades(trades);
        return;
      }

      const filtered = trades.filter(
        (trade) =>
          trade.title.toLowerCase().includes(query) ||
          trade.qualification.toLowerCase().includes(query)
      );

      setFilteredTrades(filtered);
    }, 400); // debounce delay

    return () => clearTimeout(timer);
  }, [searchText, trades]);

  return (
    <section className="trades-section container my-5">
      {/* SEARCH BAR */}
      <div className="trades-search mb-3">
        <Search size={16} />
        <input
          type="text"
          placeholder="Search trade or qualification"
          value={searchText}
          onChange={(e) => setSearchText(e.target.value)}
        />
      </div>

      {/* TABLE */}
      <div className="table-responsive">
        <table className="table trades-table">
          <thead>
            <tr>
              <th>S.#</th>
              <th>Apply for New Trade</th>
              <th>Required Qualification</th>
              <th className="text-end">Registration</th>
            </tr>
          </thead>

          <tbody>
            {filteredTrades.length ? (
              filteredTrades.map((trade, index) => (
                <tr key={trade.id}>
                  <td>{index + 1}</td>
                  <td>{trade.title}</td>
                  <td>{trade.qualification}</td>
                  <td className="text-end">
                  <a
                    href={trade.applyLink}
                    target="_blank"
                    rel="noopener noreferrer"
                    className="btn  btn-sm btn-apply"
                  >
                    Apply Now
                  </a>
                </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="4" className="text-center py-4">
                  No matching trades found.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </section>
  );
};

export default NavttcPrograms;
