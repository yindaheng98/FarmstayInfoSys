update 商户 set 商户评级=100*(SELECT count(*) FROM Farmstay.评价 where 商户='testtest' and 打分>100)/(SELECT count(*) FROM Farmstay.评价 where 商户='testtest') where 用户名='testtest';
