import "./UpcomingPrograms.css";
import { CalendarDays, MapPin, Search } from "lucide-react";
import { useEffect, useState } from "react";

const UpcomingPrograms = () => {

  const months = [
    "JAN","FEB","MAR","APR","MAY","JUN",
    "JUL","AUG","SEP","OCT","NOV","DEC"
  ];

  // 🔹 ORIGINAL DATA (DB later)
  const programsByMonth = {
    DEC: [
      {
        title: "International Workplace Mediators’ Training Program",
        date: "08 to 12 December, 2025",
        location: "IBA City Campus, Karachi",
      },
      {
        title: "Directors' Training Program",
        date: "08 to 12 December, 2025",
        location: "IBA in Islamabad, NIBAF",
      },
      {
        title: "Directors' Training Program for SOEs",
        date: "15 to 17 December, 2025",
        location: "IBA in Islamabad, NIBAF",
      },
    ],
    JAN: [
      {
        title: "The ESG Boardroom",
        date: "12–14 January, 2026",
        location: "IBA in Islamabad, NIBAF",
      },
    ],
  };

  // 🔹 STATE
  const [searchText, setSearchText] = useState("");
  const [filteredData, setFilteredData] = useState(programsByMonth);

  // 🔹 DEBOUNCED SEARCH
  useEffect(() => {
    const timer = setTimeout(() => {

      if (!searchText.trim()) {
        setFilteredData(programsByMonth);
        return;
      }

      const filtered = {};

      months.forEach((month) => {
        const programs = programsByMonth[month]?.filter((p) =>
          p.title.toLowerCase().includes(searchText.toLowerCase())
        );

        if (programs?.length) {
          filtered[month] = programs;
        }
      });

      setFilteredData(filtered);

    }, 300); // ⏱ debounce delay

    return () => clearTimeout(timer);

  }, [searchText]);

  // 🔹 scroll handler
  const scrollToMonth = (month) => {
    const section = document.getElementById(month);
    if (section) {
      section.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  };

  const monthsToRender = searchText
  ? Object.keys(filteredData)   // only months with results
  : months;                     // all months


  return (
    <section className="up-programs container my-5">

      {/* HEADER */}
      <div className="d-flex justify-content-between align-items-center mb-3">
        {/* <h2 className="up-title">Upcoming Programs</h2> */}

        <div className="d-flex gap-2">
          {/* <button className="btn btn-warning btn-sm">Download Calendar</button> */}
          {/* <button className="btn btn-warning btn-sm">Program Finder</button> */}
        </div>
      </div>

      {/* MONTH FILTER */}
      <div className="month-filter mb-4">
        {months.map((m) => (
          <span key={m} onClick={() => scrollToMonth(m)}>
            {m}
          </span>
        ))}
      </div>

      {/* SEARCH */}
      <div className="search-box mb-4">
        <h6>Search Our Open-Enrollment Programs</h6>
        <div className="d-flex">
          <div className="search-input flex-grow-1">
            <Search size={16} />
            <input
              type="text"
              placeholder="Search Program"
              value={searchText}
              onChange={(e) => setSearchText(e.target.value)}
            />
          </div>
          <button
            className="btn btn-warning btn-sm ms-2"
            onClick={() => setSearchText("")}
          >
            Clear Text
          </button>
        </div>
      </div>

      {/* MONTH SECTIONS */}
      {monthsToRender.map((month) => (
        <div key={month} id={month} className="mb-4">

          <div className="month-heading">{month}</div>

          <div className="program-list">
            {filteredData[month]?.length ? (
              filteredData[month].map((p, index) => (
                <div
                  key={index}
                  className={`program-row ${index % 2 !== 0 ? "alt" : ""}`}
                >
                  <div className="program-meta">
                    <CalendarDays size={14} />
                    <span>{p.date}</span>
                    <MapPin size={14} />
                    <span>{p.location}</span>
                  </div>
                  <a href="#">{p.title}</a>
                </div>
              ))
                ) : (
            !searchText && (
                <div className="no-program">
                No programs available for this month.
                </div>
            )
            )}

          </div>

        </div>
      ))}

    </section>
  );
};

export default UpcomingPrograms;
