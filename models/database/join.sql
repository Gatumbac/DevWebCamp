USE DEVWEBCAMP;

SELECT e.id AS id, e.name AS name, e.description AS description, e.seat_quantity AS seats, c.id AS category_id,  c.name AS category, d.id AS day_id, d.name AS day, h.id AS hour_id,  h.hour AS hour, s.id AS speaker_id, CONCAT(s.name, ' ', s.lastname) AS speaker
FROM EVENTS e 
LEFT JOIN CATEGORIES c ON e.category_id = c.id
LEFT JOIN DAYS d ON e.day_id = d.id
LEFT JOIN HOURS h ON e.hour_id = h.id
LEFT JOIN SPEAKERS s ON e.speaker_id = s.id;