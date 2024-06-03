# Laravel LMS Application 


## Functionality Overview

1. **Role-Based Access Control:**
   - Admin: Full authority (add, update, delete, view all).
   - Academic Head: Can create courses and manage modules (add, update, delete) in draft mode. Can update published courses within 6 hours of publishing.
   - Teacher & Student: Can access modules.

2. **Course Management:**
   - Academic Head can create courses with the following attributes:
     - id
     - name
     - seo_url
     - faculty
     - category
     - status (draft, publish)

3. **Module Management:**
   - Under each course, Academic Head can add, update, and delete modules with the following attributes:
     - id
     - code
     - name
     - semester
     - batch_year
     - credit

4. **Dynamic Syllabus Display:**
   - Students registered in different batches will see the appropriate set of modules:
     - If registered in 2023 batch, display the old set of modules.
     - If registered in 2024 batch, display the new set of modules.

## Example Scenario

In 2023, the B.Sc in Computing program had one set of modules consisting of 10 modules spanning 2 semesters.

In 2024, the institute updated the syllabus:
   - Added 2 new modules
   - Removed 1 module
   - Changed credit values for 2 modules