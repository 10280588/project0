public function get_and_search($slug)
    {   
        $totalQuery = array();
        $resultQuery = array();
        $beginTime = $this->input->get('begin_time');
        $endTime = $this->input->get('end_time');
        $department = $this->input->get('department');
        $gened = $this->input->get('gened');
        $facultyCheck = $this->input->get('faculty_check');
        $titleCheck = $this->input->get('title_check');
        $descriptionCheck = $this->input->get('description_check');
        
            
        if(str_word_count($slug, 0, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890') != 1) 
        {
            $slugPieces = str_word_count($slug, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
            
            $this->db->select('Courses.course_unique, Courses.title');
            $this->db->from('Courses');
            $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique');
            $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number');
            
            foreach ($slugPieces as $slugPiece)
            {
                $this->db->like('title', $slugPiece);
            }
            
            $this->db->order_by('course_unique','asc');
            $query = $this->db->get();
            $totalQuery = $query->result_array();
            
            foreach($totalQuery as $tQuery)
            {
                $i = FALSE;
                
                foreach($resultQuery as $rQuery)
                {
                    if($tQuery['course_unique'] == $rQuery['course_unique'])
                    {
                    $i=TRUE;
                    }
                }
                
                if($i === FALSE)
                {
                    array_push($resultQuery, $tQuery);
                }                
            }
        }
        
        else
        {
            $this->db->select('Courses.course_unique, Courses.title');
            $this->db->from('Courses');
            $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique');
            $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number');
            $this->db->like('title', $slug);
            $this->db->order_by('course_unique','asc');
	        $query = $this->db->get();
	        $totalQuery = $query->result_array();
	        foreach($totalQuery as $tQuery)
            {
                $i = FALSE;
                foreach($resultQuery as $rQuery)
                {
                    if($tQuery['course_unique'] == $rQuery['course_unique'])
                    {
                    $i=TRUE;
                    }
                }
                if($i === FALSE)
                {
                    array_push($resultQuery, $tQuery);
                }
            }
	    }
	    
        return $resultQuery;		
    }
    
    public function get_or_search($slug)
    {   
        $totalQuery = array();
        $resultQuery = array();
            
        if(str_word_count($slug, 0, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890') != 1) 
        {
            $slugPieces = str_word_count($slug, 1, 'àáãâäåçèéêëìíîïðñòóôõöùúûüýÿ1234567890');
            foreach ($slugPieces as $slugPiece)
            {
                $this->db->select('Courses.course_unique, Courses.title');
                $this->db->from('Courses');
                $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique');
                $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number');
                $this->db->like('title', $slugPiece);
                $this->db->order_by('course_unique','asc');
	            $query = $this->db->get();
	            $totalQuery = array_merge($totalQuery, $query->result_array());
            }
            
            foreach($totalQuery as $tQuery)
            {
                $i = FALSE;
                
                foreach($resultQuery as $rQuery)
                {
                    if($tQuery['course_unique'] == $rQuery['course_unique'])
                    {
                    $i=TRUE;
                    }
                }
                
                if($i === FALSE)
                {
                    array_push($resultQuery, $tQuery);
                }                
            }
        }
        
        else
        {
            $this->db->select('Courses.course_unique, Courses.title');
            $this->db->from('Courses');
            $this->db->join('Course_Faculty','Courses.course_unique = Course_Faculty.course_unique');
            $this->db->join('Faculty','Course_Faculty.facl_number = Faculty.facl_number');
            $this->db->like('title', $slug);
            $this->db->order_by('course_unique','asc');
	        $query = $this->db->get();
	        $totalQuery = $query->result_array();
	        foreach($totalQuery as $tQuery)
            {
                $i = FALSE;
                
                foreach($resultQuery as $rQuery)
                {
                    if($tQuery['course_unique'] == $rQuery['course_unique'])
                    {
                        $i=TRUE;
                    }
                }
                if($i === FALSE)
                {
                    array_push($resultQuery, $tQuery);
                }
            }
	    }
	    
        return $resultQuery;		
    }
