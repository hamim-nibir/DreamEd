$sql = "INSERT INTO academic_background ($id_column, degree, institute, start_year, end_year, grade) VALUES (?, ?, ?, ?, ?, ?)";

$sql = "SELECT question_id, description, answer FROM question WHERE q_id = ?"

$sql =  " Select author , blog_title , blog_content from blog "

$sql .= "WHERE blog_title like '%$searchQuery%' "

$sql .= "WHERE tag = 'University Review' ";

$sql =  " Select author , blog_title , blog_content from blog ";

$sql .= "WHERE blog_title like '%$searchQuery%' "

$academicSql = "SELECT * FROM academic_background WHERE sid = ? ORDER BY academic_id DESC";

-- Check for duplicate username or email
    $sql = "SELECT * FROM `$user_type` WHERE username = ? OR email = ?"

$sql = "SELECT username , email , first_name , last_name , profile_picture , designation ,research_interest From faculty WHERE uid IN (SELECT aid FROM academic_background WHERE institute = '$uni_name' AND aid IS NOT NULL)"

 $sql .=  " AND research_interest LIKE '%$research_q%'"

   $sql .= " AND first_name LIKE '%$faculty_query%' AND  research_interest LIKE '%$faculty_query%' "

$sql = "SELECT name, ammount, description, image_url, scholarship_url , country FROM scholarship"

$sql .= " WHERE name LIKE '%$uni_query%'"

$sql .= " WHERE name LIKE '%$uni_query%' AND  country LIKE '%$country_query%' "

$sql .= " WHERE acceptance_rate <= $rng"

-- Insert data into the blog table
    $query = "INSERT INTO blog (blog_title, tag,  blog_content , author) 
              VALUES ('$blogTitle', '$tags', '$blogContent' , '$authorname')"

$sql = "SELECT university_id, name, city, zip_code, country, acceptance_rate, description , website_link ,  image_url FROM university"

$sql .= " WHERE name LIKE '%$uni_query%'"

$sql .= " WHERE name LIKE '%$uni_query%' AND  country LIKE '%$country_query%'

$sql = "UPDATE $user_type 
                SET first_name = ?, last_name = ?, contact_no = ?, email = ?, current_institute = ?, designation = ?, research_interest = ? 
                WHERE uid = ?"


SELECT first_name , last_name , email, profile_picture From alumni WHERE uid IN (SELECT DISTINCT fid from academic_background WHERE fid IS NOT NULL AND 'United International University' IN (SELECT institute from academic_background Where sid = 2)) AND first_name IS NOT NULL