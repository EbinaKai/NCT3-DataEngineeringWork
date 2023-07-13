SELECT s.gakusei_id, s.kamoku_id, s.seiseki, k.kamoku_id, k.kamoku_mei
FROM seiseki_t AS s
INNER JOIN kamoku_t AS k ON k.kamoku_id = s.kamoku_id;