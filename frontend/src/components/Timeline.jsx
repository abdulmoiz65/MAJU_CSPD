import './Timeline.css';

const Timeline = ({ timeline }) => {
  if (!timeline || timeline.length === 0) return null;

  const hasAnyDate = timeline.some(item => item.date);
  if (!hasAnyDate) return null;

  return (
    <div className="timeline-card">
      <div className="timeline-header">
        <h4>Timeline</h4>
      </div>
      <div className="timeline-body">
        {timeline.map((item, index) =>
          item.date ? (
            <div
              key={index}
              className={`timeline-row ${index % 2 === 0 ? 'even' : 'odd'}`}
            >
              <span className="timeline-label">{item.label}</span>
              <span className="timeline-date">{item.date}</span>
            </div>
          ) : null
        )}
      </div>
    </div>
  );
};

export default Timeline;
