# Testing Checklist - Candidate Management System

## Feature Testing

### 1. Excel File Upload and Processing
- [ ] Upload valid Excel file (.xlsx, .xls, .csv)
- [ ] Import candidates with all required fields
- [ ] Handle invalid file formats (show error)
- [ ] Validate duplicate email addresses
- [ ] Parse previous_experience field correctly
- [ ] Verify all data saved in database

**Test Steps:**
1. Login as Admin or Staff
2. Go to Dashboard → "Upload Excel File"
3. Upload sample file with valid data
4. Check if candidates appear in "All Candidates" list
5. Upload file with duplicate email → Should show error
6. Upload invalid file format (.pdf) → Should reject

---

### 2. Candidate CRUD Operations

#### Create Candidate
- [ ] Add new candidate with valid data
- [ ] Validation works for all fields
- [ ] Duplicate email is rejected
- [ ] Age must be 18+
- [ ] Experience years must be positive

**Test Steps:**
1. Login as Admin
2. Go to "Candidates" → "Add New Candidate"
3. Fill all fields and submit
4. Verify candidate appears in list

#### View Candidate
- [ ] View candidate details
- [ ] See all information correctly
- [ ] View interview history

#### Edit Candidate
- [ ] Update candidate information
- [ ] Email uniqueness validated (except current)
- [ ] Changes saved successfully

#### Delete Candidate
- [ ] Delete candidate with confirmation
- [ ] Related interviews also deleted (cascade)

---

### 3. Interview Scheduling

#### Schedule by Selection
- [ ] Select multiple candidates using checkboxes
- [ ] Choose interview date and type
- [ ] Interviews created successfully
- [ ] Candidate status updated

**Test Steps:**
1. Login as Admin
2. Add some candidates
3. Go to "Schedule Interview"
4. Select 3-5 candidates
5. Choose date and interview type
6. Submit and verify in "Upcoming Interviews"

#### Schedule by Range
- [ ] Enter start and end position
- [ ] Correct candidates selected
- [ ] Interviews scheduled properly

**Test Steps:**
1. Go to "Schedule Interview"
2. Use "Schedule by Range"
3. Enter range (e.g., 2-5)
4. Verify correct candidates scheduled

---

### 4. Interview Management

#### Upcoming Interviews
- [ ] View all upcoming interviews
- [ ] Download phone numbers (Excel)
- [ ] Mark interview as complete manually
- [ ] Auto-complete when date passes

**Test Steps:**
1. Schedule interviews with past dates
2. Refresh "Upcoming Interviews" page
3. Verify auto-moved to completed
4. Download phone numbers Excel file

#### Completed Interviews
- [ ] View completed interviews
- [ ] Mark as Passed
- [ ] Mark as Rejected
- [ ] Both buttons visible for Admin
- [ ] Status updates correctly

**Test Steps:**
1. Complete some interviews
2. Go to "Completed Interviews"
3. Click "Pass" → Status becomes "passed_first"
4. Click "Reject" → Status becomes "rejected_first"

#### Second Interview
- [ ] Schedule for passed candidates only
- [ ] Second interview process works
- [ ] Final hiring works correctly

---

### 5. Candidate Lists

#### All Candidates
- [ ] View all candidates
- [ ] Pagination works
- [ ] Search/filter works
- [ ] Status badges show correctly

#### Hired Candidates
- [ ] Only hired candidates shown
- [ ] Correct status display

#### Rejected Candidates
- [ ] Shows rejected_first
- [ ] Shows rejected_final
- [ ] Different badges for each type

---

### 6. Role-Based Access Control

#### Admin Role (admin@example.com)
- [ ] Can upload Excel files 
- [ ] Can create candidates
- [ ] Can edit candidates
- [ ] Can delete candidates
- [ ] Can schedule interviews
- [ ] Can mark interview results 
- [ ] Can view all lists 
- [ ] Full access to everything

#### Staff Role (staff@example.com)
- [ ] Can upload Excel files 
- [ ] Can view all candidates
- [ ] Can view all interviews 
- [ ] Cannot edit candidates 
- [ ] Cannot delete candidates 
- [ ] Cannot schedule interviews
- [ ] Cannot mark results 
- [ ] Read-only access

#### Candidate Role (candidate@example.com)
- [ ] Can view own status 
- [ ] Can see interview schedule 
- [ ] Cannot access admin panel 
- [ ] Cannot see other candidates 

**Test Steps:**
1. Logout and login as each role
2. Try to access restricted pages
3. Verify 403 error for unauthorized actions
4. Check all buttons/links visible correctly

---

### 7. Data Validation

#### Candidate Validation
- [ ] Name: Required, string, max 255
- [ ] Email: Required, unique, valid email
- [ ] Phone: Required, string
- [ ] Age: Required, integer, min 18, max 100
- [ ] Experience: Required, integer, min 0

#### Interview Validation
- [ ] Candidates: Required, array
- [ ] Date: Required, must be future date
- [ ] Type: Required, first or second

#### Excel Import Validation
- [ ] File required
- [ ] Valid format only
- [ ] Max size 2MB
- [ ] Data validation per row

---

### 8. Status Flow Testing

Test complete workflow:
```
pending 
→ first_interview_scheduled 
→ first_interview_completed 
→ passed_first / rejected_first
→ second_interview_scheduled (if passed)
→ second_interview_completed
→ hired / rejected_final
```

**Test Steps:**
1. Create candidate → Status: pending
2. Schedule first interview → Status: first_interview_scheduled
3. Mark complete → Status: first_interview_completed
4. Mark passed → Status: passed_first
5. Schedule second → Status: second_interview_scheduled
6. Mark complete → Status: second_interview_completed
7. Mark passed → Status: hired 

---

### 9. Export Functionality

#### Phone Numbers Export
- [ ] Downloads as .xlsx file
- [ ] Contains all upcoming interviews
- [ ] Includes candidate name, phone, email
- [ ] Proper formatting

#### Interview Export (if implemented)
- [ ] Exports completed interviews
- [ ] All data included
- [ ] Excel format correct

---

### 10. UI/UX Testing

#### Responsiveness
- [ ] Desktop view (1920x1080)
- [ ] Laptop view (1366x768)
- [ ] Tablet view (768x1024)
- [ ] Mobile view (375x667)

#### Navigation
- [ ] All links work
- [ ] Breadcrumbs correct
- [ ] Back buttons work
- [ ] Dashboard accessible

#### Notifications
- [ ] Success messages show
- [ ] Error messages clear
- [ ] Validation errors displayed
- [ ] Confirmation dialogs work

#### Tables
- [ ] Pagination works
- [ ] No horizontal scroll
- [ ] Sorting works (if implemented)
- [ ] Empty state shows correctly

---

### 11. Error Handling

#### Database Errors
- [ ] Duplicate email handled
- [ ] Foreign key violations caught
- [ ] Connection errors handled

#### File Upload Errors
- [ ] Invalid format rejected
- [ ] File too large rejected
- [ ] Corrupted file handled
- [ ] Empty file rejected

#### Validation Errors
- [ ] All fields validated
- [ ] Clear error messages
- [ ] Form retains data on error

---

### 12. Edge Cases

- [ ] Empty database (no candidates)
- [ ] Large dataset (1000+ candidates)
- [ ] Concurrent users
- [ ] Same candidate scheduled twice
- [ ] Past date for interviews
- [ ] Missing candidate data
- [ ] Browser back button
- [ ] Page refresh during action

---

## Performance Testing

- [ ] Page load time < 3 seconds
- [ ] Excel import (100 rows) < 10 seconds
- [ ] Database queries optimized
- [ ] No N+1 query problems

---

## Security Testing

- [ ] CSRF protection working
- [ ] SQL injection prevented
- [ ] XSS protection enabled
- [ ] Password hashing working
- [ ] Session management secure
- [ ] File upload restrictions work

---

## Test Summary

Total Features: ____ / ____
Passed: ____
Failed: ____
Pending: ____

**Date:** _____________
**Tested By:** _____________
**Version:** _____________