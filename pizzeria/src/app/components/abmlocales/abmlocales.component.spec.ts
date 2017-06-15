import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AbmlocalesComponent } from './abmlocales.component';

describe('AbmlocalesComponent', () => {
  let component: AbmlocalesComponent;
  let fixture: ComponentFixture<AbmlocalesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AbmlocalesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AbmlocalesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
