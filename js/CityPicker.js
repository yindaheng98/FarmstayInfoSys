const province_label = $("label[for=province]");
const province = document.getElementById("province");
const city_label = $("label[for=city]");
const city = document.getElementById("city");
const district_label = $("label[for=district]");
const district = document.getElementById("district");
const street_label = $("label[for=street]");
const street = document.getElementById("street");

function get_province(syncmode)
{
    show_child_area(0, province, province_label,syncmode);
    city_label.css('visibility','hidden');
    city.style.visibility = 'hidden';
    district_label.css('visibility','hidden');
    district.style.visibility = 'hidden';
    street_label.css('visibility','hidden');
    street.style.visibility = 'hidden';
    city.value='';
    district.value='';
    street.value='';
}

function get_city()
{
    let province_id=province.value;
    get_city_from_id(province_id,true);
}

function get_district()
{
    let city_id=city.value;
    get_district_from_id(city_id,true);
}

function get_street()
{
    let district_id=district.value;
    get_street_from_id(district_id,true);
}

function show_child_area(id, select, label,syncmode)//获取id所指区域的所有子区域,并填入select中
{
    let xmlhttp;
    if (window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState === 4 && xmlhttp.status === 200)
        {
            if (xmlhttp.responseText !== null && xmlhttp.responseText !== undefined && xmlhttp.responseText !== '')
            {
                select.innerHTML='';//清空内部标签
                let areas=JSON.parse(xmlhttp.responseText);//解析JSON
                for(let i in areas)
                {
                    let append = document.createElement("option");
                    append.label=areas[i].name;
                    append.value=areas[i].id;
                    select.appendChild(append);
                }
                label.css('visibility','visible');
                select.style.visibility = 'visible';
            }
            else
            {
                label.css('visibility','hidden');
                select.style.visibility = 'hidden';
            }
        }
    };
    xmlhttp.open("POST", "ajax/CityPicker.php",syncmode);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("area=" + id);
}

function get_city_from_id(province_id,syncmode)
{
    show_child_area(province_id, city, city_label,syncmode);
    district_label.css('visibility','hidden');
    district.style.visibility = 'hidden';
    street_label.css('visibility','hidden');
    street.style.visibility = 'hidden';
    district.value='';
    street.value='';
}

function get_district_from_id(city_id,syncmode)
{
    show_child_area(city_id, district, district_label,syncmode);
    street_label.css('visibility','hidden');
    street.style.visibility = 'hidden';
    street.value='';
}

function get_street_from_id(district_id,syncmode)
{
    show_child_area(district_id, street, street_label,syncmode);
}