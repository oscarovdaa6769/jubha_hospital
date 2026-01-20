<?php get_header() ;?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">


<div class="hero-find-doctor">
  <div class="hero-content">
    <h1>Find A Doctor</h1>
    <div class="icon">
      <a href="/home/"><i class="fa-regular fa-house"></a></i>  <p>/ Find A Doctor</p>
    </div>
  </div>
</div>

<div class="search-box1">
  <form action="" method="get">
  <input type="search" name="q" placeholder="Type The Keyword" />
</form>
 <select>
    <option>Select Your Year</option>
    <option>Year 1</option>
    <option>Year 2</option>
    <option>Year 3</option>
    <option>Year 4</option>
    <option>Year 5</option>
    <option>Year 6</option>
    <option>Year 7</option>
    <option>Year 8</option>
    <option>Year 9</option>
    <option>Year 10</option>
    <option>Year 11</option>
    <option>Year 12</option>
    <option>Year 13</option>
    <option>Year 14</option>
    <option>Year 15</option>
    <option>Year 16</option>
    <option>Year 17</option>
    <option>Year 18</option>
    <option>Year 19</option>
    <option>Year 20</option>
    <option>Year 21</option>
    <option>Year 22</option>
    <option>Year 23</option>
    <option>Year 24</option>
    <option>Year 25</option>
    <option>Year 26</option>
    <option>Year 27</option>
    <option>Year 28</option>
    <option>Year 29</option>
    <option>Year 30</option>
    <option>Year 31</option>
    <option>Year 32</option>
    <option>Year 33</option>
    <option>Year 34</option>
    <option>Year 35</option>
    <option>Year 36</option>
    <option>Year 37</option>
    <option>Year 38</option>
    <option>Year 39</option>
    <option>Year 40</option>
    <option>Year 41</option>
    <option>Year 42</option>
    <option>Year 43</option>
    <option>Year 44</option>
    <option>Year 45</option>
    <option>Year 46</option>
    <option>Year 47</option>
    <option>Year 48</option>
    <option>Year 49</option>
    <option>Year 50</option>
    <option>Year 51</option>
    <option>Year 52</option>
    <option>Year 53</option>
    <option>Year 54</option>
    <option>Year 55</option>
    <option>Year 56</option>
    <option>Year 57</option>
    <option>Year 58</option>
    <option>Year 59</option>
    <option>Year 60</option>
    <option>Year 61</option>
    <option>Year 62</option>
    <option>Year 63</option>
    <option>Year 64</option>
    <option>Year 65</option>
    <option>Year 66</option>
    <option>Year 67</option>
    <option>Year 68</option>
    <option>Year 69</option>
    <option>Year 70</option>
    <option>Year 71</option>
    <option>Year 72</option>
    <option>Year 73</option>
    <option>Year 74</option>
    <option>Year 75</option>
    <option>Year 76</option>
    <option>Year 77</option>
    <option>Year 78</option>
    <option>Year 79</option>
    <option>Year 80</option>
    <option>Year 81</option>
    <option>Year 82</option>
    <option>Year 83</option>
    <option>Year 84</option>
    <option>Year 85</option>
    <option>Year 86</option>
    <option>Year 87</option>
    <option>Year 88</option>
    <option>Year 89</option>
    <option>Year 90</option>
    <option>Year 91</option>
    <option>Year 92</option>
    <option>Year 93</option>
    <option>Year 94</option>
    <option>Year 95</option>
    <option>Year 96</option>
    <option>Year 97</option>
    <option>Year 98</option>
    <option>Year 99</option>
    <option>Year 100</option>
  </select>
  <button type="submit">Search</button>
</div>






<!-- News Item (visible on main page) -->
<div class="news-item" data-modal="modal-scoliosis">
  <div class="news-image">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/ccessful.png" alt="Doctor">
  </div>
  
  <div class="news-content">
    <h2>Successful Scoliosis Surgery for 14-Year-Old Girl</h2>
    
    <p>Despite the complexity of the case, the corrective procedure was completed in just five hours — a notably shorter duration compared to the typical 8–9 hours required for similar surgeries. The operation involved 11 vertebrae, from the fourth thoracic vertebra...</p>
    
    <span class="read-more">READ MORE →</span>
  </div>
</div>

<!-- Modal - Detailed version -->
<div id="modal-scoliosis" class="news-modal">
  <div class="modal-content">
    <span class="modal-close">×</span>
    
    <div class="modal-header">
      <h1>Successful Scoliosis Surgery for 14-Year-Old Girl</h1>
      <p class="modal-subtitle">Complex 11-level correction completed in just 5 hours</p>
    </div>

    <div class="modal-images">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/css/images/ccessful.png" alt="Doctor">
      
    </div>

    <div class="modal-body">
      <p><strong>Case overview:</strong> A 14-year-old girl with severe scoliosis (significant spinal curvature) underwent a multi-level spinal fusion surgery. Despite the complexity involving 11 vertebrae (starting from the fourth thoracic vertebra T4), the entire corrective procedure was successfully completed in only <strong>5 hours</strong> — considerably shorter than the usual 8–9 hours required for similar extensive corrections.</p>
      
      <p>The surgery utilized modern precision instrumentation and advanced intraoperative neuromonitoring, allowing for safer and more efficient correction of the spinal deformity.</p>
      
      <blockquote>
        "Early detection and timely surgical intervention in severe scoliosis cases are crucial. This not only prevents further progression and potential complications to heart and lung function, but also significantly improves the patient’s quality of life and self-confidence."
        <footer>— Dr. Ahmed Hamed Amin, Spine Surgeon</footer>
      </blockquote>

      <p><strong>Postoperative progress:</strong> The patient showed excellent recovery with intensive physiotherapy starting day 2 post-op. Follow-up X-rays confirmed good alignment and solid fixation. She was discharged in stable condition and continues outpatient rehabilitation.</p>
    </div>
  </div>
</div>
<script>
  document.querySelectorAll('.news-item').forEach(item => {
  item.addEventListener('click', function(e) {
    // Prevent opening modal when clicking inside text, but optional
    if (!e.target.closest('.read-more')) return;
    
    const modalId = this.getAttribute('data-modal');
    const modal = document.getElementById(modalId);
    if (modal) {
      modal.style.display = 'flex';
    }
  });
});

document.querySelectorAll('.modal-close').forEach(btn => {
  btn.addEventListener('click', function() {
    this.closest('.news-modal').style.display = 'none';
  });
});

// Close modal when clicking outside content
document.querySelectorAll('.news-modal').forEach(modal => {
  modal.addEventListener('click', function(e) {
    if (e.target === this) {
      this.style.display = 'none';
    }
  });
});
</script>

<?php get_footer() ;?>