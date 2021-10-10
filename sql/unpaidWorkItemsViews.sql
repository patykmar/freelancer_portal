DROP TABLE IF EXISTS v_unpaid_work_items;
DROP VIEW IF EXISTS v_unpaid_work_items;
CREATE VIEW v_unpaid_work_items AS
SELECT w.id                             AS id,
       c.id                             AS company_id,
       c.name                           AS company_name,
       t.name                           AS tariff_name,
       sum(w.work_duration)             AS work_duration_total,
       t.price                          AS price_per_unit,
       (sum(w.work_duration) * t.price) AS total_price
FROM work_inventory AS w
         INNER JOIN tariff t ON t.id = w.tariff_id
         LEFT JOIN company c ON w.company_id = c.id
WHERE w.invoice_id IS NULL
GROUP BY w.company_id, w.tariff_id;