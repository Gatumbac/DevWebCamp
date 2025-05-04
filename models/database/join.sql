USE DEVWEBCAMP;

SELECT e.id AS id, e.name AS name, e.description AS description, e.seat_quantity AS seats, c.name AS category, d.name AS day, h.hour AS hour, CONCAT(s.name, ' ', s.lastname) AS speaker
FROM EVENTS e 
LEFT JOIN CATEGORIES c ON e.category_id = c.id
LEFT JOIN DAYS d ON e.day_id = d.id
LEFT JOIN HOURS h ON e.hour_id = h.id
LEFT JOIN SPEAKERS s ON e.speaker_id = s.id;